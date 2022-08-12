<?php

namespace yunwuxin\oauth\server;

use Psr\Http\Message\ResponseInterface;

class Bridge
{
    public static function fromThinkRequest(\think\Request $request)
    {
        $serverRequest = new Request(
            $request->method(),
            $request->url(),
            $request->header(),
        );

        $params = $request->get();
        $data   = $request->post();

        return $serverRequest
            ->withQueryParams($params)
            ->withParsedBody($data);
    }

    public static function toThinkResponse(ResponseInterface $response)
    {
        $code = $response->getStatusCode();
        if ($code == 302) {
            $url = $response->getHeaderLine('Location');
            return redirect($url);
        } else {
            $header = [];
            foreach ($response->getHeaders() as $name => $values) {
                $header[$name] = implode(', ', $values);
            }
            $data = (string) $response->getBody();
            return response($data, $code, $header);
        }
    }
}
