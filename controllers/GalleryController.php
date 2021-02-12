<?php

namespace app\controllers;

use app\model\repositories\GalleryRepository;
use app\model\entities\Gallery;
use app\engine\Request;

class GalleryController extends Controller
{
    public function actionGallery()
    {
        $gallery = (new GalleryRepository)->getAll();

        echo $this->renderLayouts("gallery", [
            "gallery" => $gallery
        ]);
    }

    public function actionGalleryItem()
    {
        $id = (new Request())->getParams()['id'];

        $gallery = (new GalleryRepository)->getOne($id);

        echo $this->renderLayouts("galleryItem", [
            "itemGallery" => $gallery,
        ]);
    }
}
