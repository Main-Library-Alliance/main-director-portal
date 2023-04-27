#!/bin/python

# This script takes a CSV document exported from the old schema 
# and converts it to SQL statements for importing to the new schema

import pandas as pd
import os

old_table_dict = {
    "aspen": [],
    "data_table": [],
    "deep_freeze": [],
    "diagram_survey": [],
    "econtent": [],
    "econtentlist": [],
    "envisionware": [],
    "inventory": [],
    "ip_addresses": [],
    "libraries": [],
    "mobile_app": [],
    "reset_password_temp": [],
    "technical_contacts": [],
    "users": [],
    "websites": []
}

def remove_prefix(text, prefix):
    return text[text.startswith(prefix) and len(prefix):]

files = os.listdir("data")

old_filename_table_tuples = [( f, remove_prefix(f, "mainlib_libraryinfo_table_")[:-4]) for f in files]
old_filename_table_dict = dict((x, y) for x, y in old_filename_table_tuples)

for f in files:
    table_data = pd.read_csv("data/"+f)

    old_table_dict[old_filename_table_dict[f]] = table_data


# Restructure the data in the format that the new database will expect

new_table_dict = {
    "econtent": [],
    "envisionware": [],
    "envisionware_console": [],
    "envisionware_lptone": [],
    "envisionware_mobileprint": [],
    "envisionware_mobileprint_email": [],
    "envisionware_pcreservation": [],
    "libraries": [],
    "library_abbreviation": [],
    "library_aspen": [],
    "library_deepfreeze": [],
    "library_diagram": [],
    "library_econtent": [],
    "library_google_suite": [],
    "library_ip_addresses": [],
    "library_magellan": [],
    "library_public_PC_info": [],
    "library_survey": [],
    "library_technical_contact": [],
    "library_website": [],
    "library_web_statistics": [],
    "technical_contact_email": [],
    "users": [],
    "user_friendly_name": [],
    "user_library_relation": [],
    "user_require_password_change": [],
    "user_reset_links": [],
    "user_roles": []
}

# libraries -> libraries
# Old columns: id, library_name, library_abbr
# New columns: uuid, libraryName

# uuid will be generated during the insert using unhex(replace(uuid(),'-',''))
new_library_df = pd.DataFrame()
new_library_df['libraryName'] = old_table_dict["libraries"]["library_name"]
new_table_dict["libraries"] = new_library_df

# libraries -> library_abbreviation
new_library_abbreviation_df = pd.DataFrame()
new_library_abbreviation_df = old_table_dict["libraries"].copy()
new_library_abbreviation_df.rename(columns={"library_name": "libraryName", "library_abbr": "abbreviation"}, inplace=True)
new_library_abbreviation_df.drop(columns=["id"], inplace=True)
new_table_dict["library_abbreviation"] = new_library_abbreviation_df

# users -> users
new_users_df = pd.DataFrame()
new_users_df = old_table_dict['users']
new_users_df.drop(columns=["name", "active", "passwordChanged", "datetime", "id", "role", "hash"], inplace=True)
new_table_dict["users"] = new_users_df








#===================================================================================================================#
# GENERATE SQL 
sqlFile = open("test.sql", "w")
#libraries table
for index, row in enumerate(new_table_dict["libraries"].values):
    sqlFile.write("INSERT INTO libraries (uuid, libraryName) VALUES (unhex(replace(uuid(),'-','')), '{}');\n".format(row[0]))

#users table
for index, row in enumerate(new_table_dict["users"].values):
    print("INSERT INTO users (uuid, email, username, password) VALUES (unhex(replace(uuid(),'-','')), '{}', '{}', '{}');".format(row[0],row[1],row[2]));

#library_abbreviation table
for index, row in enumerate(new_table_dict["library_abbreviation"].values):
    sqlFile.write("INSERT INTO library_abbreviation (libraryName, abbreviation) VALUES ('{}', '{}');\n".format(row[0], row[1]))

sqlFile.close()
