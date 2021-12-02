<?php

namespace YasinKose\FileHandler;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

trait InteractsWithFile
{
    private array $fhModels = [];

    private FileHandler $fh;

    /**
     * @param $request
     * @return $this
     */
    public function addFile($request)
    {
        $this->fh = ($this->fh ??= app(FileHandler::class))
            ->addFile($request);

        return $this;
    }


    /**
     * @return false|Collection
     * @throws Exception
     */
    public function toFileCollection()
    {
        return $this->fhSave();
    }

    /**
     * @return false|Collection
     * @throws Exception
     */
    protected function fhSave()
    {
        $fileHandler = $this->fh->sendFile();

        if (!$fileHandler) {
            return false;
        }

        foreach ($fileHandler as $file) {
            $model = app(config("file-handler.model"));
            $model->slug = $file->slug;
            $model->created_by = Auth::id() ?? null;

            $this->fhModels[] = $model;
        }

        return collect($this->file()->saveMany($this->fhModels));
    }

    public function file()
    {
        return $this->morphMany(config('file-handler.model'), 'filedable');
    }

    /**
     * @return array
     * @throws Exception
     */
    public function toFileArray(): array
    {
        return $this->fhSave()->toArray();
    }
}
