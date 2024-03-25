<?php

/**
 * File class
 * 
 * This class contains methods for uploading files
 * 
 * methods: upload
 */
class File
{
    /**
     * Upload a file
     * 
     * @param array $file The file to upload
     * @param string $path The path to upload the file to
     * 
     * @return array An array containing the status of the upload and a message
     */
    public static function upload(array $file, string $path) : array
    {
        // Check if path exists or create it
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
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