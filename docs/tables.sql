CREATE TABLE `libraries` (
 `uuid` binary(16) NOT NULL,
 `uuid_readable` varchar(36) GENERATED ALWAYS AS (insert(insert(insert(insert(hex(`uuid`),9,0,_utf8mb4'-'),14,0,_utf8mb4'-'),19,0,_utf8mb4'-'),24,0,_utf8mb4'-')) VIRTUAL,
 `libraryName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
 PRIMARY KEY (`uuid`),
 KEY `libraryNameIndex` (`libraryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE library_abbreviation (
    `libraryName` VARCHAR(100) PRIMARY KEY,
    `libraryAbbr` text,
    FOREIGN KEY (libraryName) REFERENCES libraries(libraryName) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE `envisionware` (
 `uuid` binary(16) PRIMARY KEY,
 `uuid_readable` varchar(36) GENERATED ALWAYS AS (insert(insert(insert(insert(hex(`uuid`),9,0,_utf8mb4'-'),14,0,_utf8mb4'-'),19,0,_utf8mb4'-'),24,0,_utf8mb4'-')) VIRTUAL,
 `libraryUuid` binary(16) NOT NULL,
 UNIQUE KEY `libraryUuid` (`libraryUuid`),
 CONSTRAINT `envisionware_ibfk_1` FOREIGN KEY (`libraryUuid`) REFERENCES `libraries` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE library_website (
    libraryUuid BINARY(16) PRIMARY KEY,
    url TEXT NOT NULL,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE library_aspen (
    libraryUuid BINARY(16) PRIMARY KEY,
    url TEXTi NOT NULL,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE library_diagram (
    libraryUuid BINARY(16) PRIMARY KEY,
    lastUpdate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    sha1hash BINARY(20),
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
)


CREATE TABLE library_deepfreeze (
    libraryUuid BINARY(16) PRIMARY KEY,
    licenceCount INT NOT NULL DEFAULT 0,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE library_ip_addresses (
    libraryUuid BINARY(16) PRIMARY KEY,
    primaryAddress INT UNSIGNED NOT NULL,
    secondaryAddress INT UNSIGNED,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE library_econtent (
    libraryUuid BINARY(16) PRIMARY KEY,
    econtentId BINARY(16) NOT NULL,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (econtentId) REFERENCES econtent(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE library_public_PC_info (
    libraryUuid BINARY(16) PRIMARY KEY,
    adminPassword TEXT NOT NULL,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE library_web_statistics (
    libraryUuid BINARY(16) PRIMARY KEY,
    hasMenuPage BOOLEAN NOT NULL DEFAULT FALSE,
    hasSplashpage BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE library_google_suite (
    libraryUuid BINARY(16) PRIMARY KEY,
    hasMainGoogleDrive BOOLEAN NOT NULL DEFAULT FALSE,
    hasMainGmail BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON  DELETE CASCADE
);

CREATE TABLE library_magellan (
    libraryUuid BINARY(16) PRIMARY KEY,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE library_technical_contact (
    uuid BINARY(16) PRIMARY KEY,
    libraryUuid BINARY(16) NOT NULL,
    name TEXT NOT NULL,
    UNIQUE(libraryUuid, name),
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE technical_contact_email (
    name VARCHAR(100) PRIMARY KEY,
    email TEXT NOT NULL,
    FOREIGN KEY (name) REFERENCES library_technical_contact(name) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE envisionware_pcreservation (
    envisionwareUuid BINARY(16) PRIMARY KEY,
    version TEXT,
    FOREIGN KEY (envisionwareUuid) REFERENCES envisionware(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE envisionware_lptone (
    envisionwareUuid BINARY(16) PRIMARY KEY,
    version TEXT,
    hasVending BOOLEAN DEFAULT FALSE,
    prtReleaseMode TEXT,
    FOREIGN KEY (envisionwareUuid) REFERENCES envisionware(uuid) ON DELETE CASCADE ON UPDATE CASCADE
)

CREATE TABLe envisionware_console (
    envisionwareUuid BINARY(16) PRIMARY KEY,
    model TEXT,
    serviceTag TEXT,
    operatingSystem TEXT,
    localIPAddress INT UNSIGNED,
    acronisAccount TEXT,
    FOREIGN KEY (envisionwareUuid) REFERENCES envisionware(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE envisionware_mobileprint (
    uuid BINARY(16) PRIMARY KEY,
    envisionwareUuid BINARY(16) NOT NULL,
    version TEXT,
    url TEXT,
    FOREIGN KEY (envisionwareUuid) REFERENCES envisionware(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE envisionware_mobileprint_email (
    emailAddress VARCHAR(200) PRIMARY KEY,
    printerType TEXT,
    mobileprintUuid BINARY(16) NOT NULL,
    FOREIGN KEY (mobileprintUuid) REFERENCES envisionware_mobileprint(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE users (
    uuid BINARY(16) PRIMARY KEY,
    `uuid_readable` varchar(36) GENERATED ALWAYS AS (insert(insert(insert(insert(hex(`uuid`),9,0,_utf8mb4'-'),14,0,_utf8mb4'-'),19,0,_utf8mb4'-'),24,0,_utf8mb4'-')) VIRTUAL,
    username VARCHAR(100) UNIQUE NOT NULL,
    email TEXT,
    salt CHAR(64) NOT NULL,
    password CHAR(60) CHARACTER SET latin1 COLLATE latin1_bin
);

CREATE TABLE user_library_relation (
    uuid BINARY(16) PRIMARY KEY,
    userUuid BINARY(16) NOT NULL,
    libraryUuid BINARY(16) NOT NULL,
    UNIQUE KEY (userUuid, libraryUuid),
    FOREIGN KEY (userUuid) REFERENCES users(uuid) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (libraryUuid) REFERENCES libraries(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE user_roles (
    uuid BINARY(16) PRIMARY KEY,
    userUuid BINARY(16) NOT NULL,
    role VARCHAR(64),
    FOREIGN KEY (userUuid) REFERENCES users(uuid) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE user_friendly_name (
    userUuid BINARY(16) PRIMARY KEY,
    name TEXT,
    FOREIGN KEY (userUuid) REFERENCES users(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE user_require_password_change (
    userUuid BINARY(16) PRIMARY KEY,
    FOREIGN KEY (userUuid) REFERENCES users(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE reset_links (
    uuid BINARY(16) PRIMARY KEY,
    userUuid BINARY(16),
    expiration DATETIME,
    FOREIGN KEY (userUuid) REFERENCES users(uuid) ON UPDATE CASCADE ON DELETE CASCADE
);
