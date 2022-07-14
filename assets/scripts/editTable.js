   $(function() {
    // I finally figured out how to nicely and easily repopulate an 'edit view' with JS, from a php database (at least in a table form).
        $('.editBtn').on("click", function(e) {
            $('.editBtn').css("display", "none");
            e.preventDefault();
            

            // grab the ID of the row being edited
            var id = $(this).parent('td').parent('tr').attr('id');
            
            // this nicely grabs the existing text inside the cells
            // so we wanna hold onto this and add it to an array
            var dataArr = [];
            $($(this).parent('td').parent('tr').children()).each(function() {
               //console.log($(this).text().trim());
               dataArr.push($(this).text());
            });

            
            // then we loop through again
            i = 0; // using this to keep track
            $($(this).parent('td').parent('tr').children()).each(function() {
               //console.log($(this).text();
               
               
               if ($(this).attr('class') !== "edit") {
                
                // this skips the first field which is almost always the library name, so that way it doesn't get turned into an input field
                if (i !== 0) {
               $(this).html('<input type="text" class="field" value="' + dataArr[i] + '">');
                }
                
               console.log(dataArr[i]);
               i++;
               } else {
                   $(this).html('<input type="hidden" name="id" id="libID" value="' + id + '"><input type="submit" id="saveBtn" name="dfSubmit" value="Submit">')
               }
               //dataArr.push($(this).text().trim());
            });
            
            
            
            console.log(dataArr);
        });
        
        $('td').on("focus", ".field", function() {
            $('.field').on('keypress', function(event) {
                console.log(event.keyCode);
                if (event.keyCode == 13) {
                    console.log("submit!");
                }
                
            })
        });
   });
   
   