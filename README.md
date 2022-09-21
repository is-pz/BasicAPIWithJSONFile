# Basic fake API

It is a simple and basic API attempt to read data from a JSON file, it has the ability to save new records in the same file.

Fake is for not complying with the rules of an API or REST API.

## List of files

* dbJson.php - This file contains the methods for reading and writing data from a JSON file.

* apiJson.php - This file contains the methods for displaying the information, and connects to the script needed to save images.

* addNewEntry.php - This file validates that data is being received and is valid.

* saveImage.php - This file contains the methods for saving jpg/jpeg images.

* index.php - This file displays only all elements or only one element of the JSON file.

# Use
You need a JSON file in the root of the directory where the other files are located, the default name of the file is json.json, if you change its name or move it to another directory you must change it in the apiJson.php file.

You need a folder with the name "img" in the root to store the uploaded images, if you want to change the location you must do it in the saveImage.php file.

### Routes

* / Displays all data in the JSON file.

* /?id= any number Displays the matching item from the JSON file.
    * Example: /?id=1
    * Result: 
                {
                    "item": [{
    	                        "id": 1,
    	                        "title": "title",
    	                        "image": "name image"
                            }]
                }
* /addNewEntry.php Receives by POST the title field and the image file to be saved.

