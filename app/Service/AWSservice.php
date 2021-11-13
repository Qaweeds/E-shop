<?php


namespace App\Service;


use App\Service\Contracts\StoreServiceInterface;
use Illuminate\Support\Facades\Storage;

class AWSservice implements StoreServiceInterface
{

    public function get(string $link)
    {
        try {
            $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
            $options = [
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $link,
                'ACL' => 'public-read'
            ];
            $cmd = $client->getCommand('GetObject', $options);
            $request = $client->createPresignedRequest($cmd, '+7 days');

            return (string) $request->getUri();
        }catch (\Exception $e){
            logs()->warning('AWS - ' . $e->getMessage());
            return '';
        }
    }
}
