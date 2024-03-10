<?php
class File
{
    public static function upload($file, $path)
    {
        // Extract file extension
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Generate a unique identifier
        $uniqueIdentifier = uniqid();

        // Construct file name with unique identifier, cleaned file name, and extension
        $fileName = $uniqueIdentifier . '_' . '.' . $fileExtension;

        // Move the file to the specified path
        $filePath = $path . '/' . $fileName;

        try {
            move_uploaded_file($file['tmp_name'], $filePath);
            return [
                'status' => true,
                'message' => 'File uploaded successfully',
                'file_path' => $filePath
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Failed to upload file'
            ];
        }
    }
}