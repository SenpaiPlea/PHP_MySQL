<?php
class Directories
{

    // This class should have a method that takes the directory name and file content as parameters, creates the directory and file, and returns the path to the created file or an error message if something goes wrong.

    // Use file_exists() or is_dir()) to check if the directory already exists before attempting to create it. 
    // If it does exist, you can return a message indicating that a directory with that name already exists. 

    // Use mkdir() function to create the directory and file_put_contents() function to create the "readme.txt" file with the content provided by the user. 

    // Handle the case where creation fails (wrap steps 3–4 in conditionals checking the return values)


    public function createDirectoryAndFile($directoryName, $fileContent)
    {
        $directoryPath = 'directories/' . $directoryName;
        $fileInsideDirectory = $directoryPath . '/readme.txt';

        
        

        if (is_dir($directoryPath)) {
            return "A directory already exists with that name.";
        }

        if (!mkdir($directoryPath, 0777, true)) {
            return "Error creating directory.";
        }

        if (file_put_contents($fileInsideDirectory, $fileContent) == false) {
            return "Error creating file.";
        }




        return $fileInsideDirectory;
    }
}
?>