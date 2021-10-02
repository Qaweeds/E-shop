<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

}
