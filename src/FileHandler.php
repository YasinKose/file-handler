<?php

namespace YasinKose\FileHandler;

use Exception;
use Illuminate\Http\UploadedFile;
use Ixudra\Curl\Facades\Curl;

class FileHandler
{
    /** @var resource $curlObject cURL request */
    protected $curlObject = null;

    /** @var resource $fileList cURL file list */
    protected $fileList = null;

    public function __construct()
    {
        $url = trim(config("file-handler.server-url"), "/") . "/file/upload";

        $this->curlObject = Curl::to($url)
            ->withData([
                'apiKey' => config("file-handler.api-key")
            ])
            ->asJsonResponse()
            ->returnResponseObject();
    }

    /**
     * @param array|null $files
     * @return false|mixed
     * @throws Exception
     */
    public function sendFile(?array $files = [])
    {
        if (!empty($files)) {
            $this->addFile($files);
        }

        if (empty($this->fileList)) {
            return false;
        }

        foreach ($this->fileList as $index => $file) {
            $this->curlObject->withFile(
                "file[$index]",
                $file['pathName'],
                $file['mimeType'],
                $file['originalName']
            );
        }

        return $this->returnResponse();
    }

    /**
     * @param $files
     * @return $this
     */
    public function addFile($files): FileHandler
    {

        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $this->setFile($file);
            } elseif (is_array($file)) {
                $this->addFile($file);
            }
        }

        return $this;
    }

    /**
     * @param UploadedFile $uploadedFile
     */
    private function setFile(UploadedFile $uploadedFile)
    {
        $this->fileList[] = [
            'pathName' => $uploadedFile->getPathName(),
            'mimeType' => $uploadedFile->getMimeType(),
            'originalName' => $uploadedFile->getClientOriginalName()
        ];
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function returnResponse()
    {
        $response = $this->curlObject
            ->post();

        if ($response->status != 200) {
            if (config("app.debug")) {
                throw new Exception("İşlem tamamlanamadı!");
            }

            return false;
        }

        return $response->content->attr;
    }
}
