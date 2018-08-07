<?php

/*
 * This file is part of asm89/stack-cors.
 *
 * (c) Alexander <iam.asm89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cross\Cors;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors implements HttpKernelInterface
{
    /**
     * @var \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    private $app;

    /**
     * @var \Cross\Cors\CorsService
     */
    private $cors;

    private $defaultOptions = array(
        'allowedHeaders'         => array('Origin', 'Content-Type', 'Cookie', 'X-CSRF-TOKEN', 'Accept', 'Authorization', 'X-XSRF-TOKEN'),
        'allowedMethods'         => array('GET', 'POST', 'PATCH', 'PUT', 'OPTIONS'),
        'allowedOrigins'         => array('http://eimp.xinyuapp.net', 'http://localhost'),
        'allowedOriginsPatterns' => array(),
        'exposedHeaders'         => false,
        'maxAge'                 => false,
        'supportsCredentials'    => false,
    );

    public function __construct(HttpKernelInterface $app, array $options = array())
    {
        $this->app  = $app;
        $this->cors = new CorsService(array_merge($this->defaultOptions, $options));
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        if (!$this->cors->isCorsRequest($request)) {
            return $this->app->handle($request, $type, $catch);
        }

        if ($this->cors->isPreflightRequest($request)) {
            return $this->cors->handlePreflightRequest($request);
        }

        if (!$this->cors->isActualRequestAllowed($request)) {
            return new Response('Not allowed.', 403);
        }

        $response = $this->app->handle($request, $type, $catch);

        return $this->cors->addActualRequestHeaders($response, $request);
    }
}
