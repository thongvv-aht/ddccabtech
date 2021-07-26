<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Http\Request;
use GoDaddy\WordPress\MWC\Common\Http\Response;
use GoDaddy\WordPress\MWC\Common\Tests\Helpers\Http\RequestHelper;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Traits\AdaptsRequestsTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\AdaptsRequestsTrait
 */
class AdaptsRequestsTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\AdaptsRequestsTrait::doAdaptedRequest()
     * @throws BaseException
     * @throws Exception
     */
    public function testCanDoAdaptedRequestSuccessfully()
    {
        $traitMock = $this->getMockForTrait(AdaptsRequestsTrait::class);
        $adapterMock = $this->getDataSourceAdapterMock();

        RequestHelper::fake();

        $adaptedResponse = $traitMock->doAdaptedRequest($adapterMock);

        $this->assertIsArray($adaptedResponse);
        $this->assertEquals($adapterMock->convertToSource(), $adaptedResponse);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\AdaptsRequestsTrait::doAdaptedRequest()
     * @throws BaseException
     * @throws Exception
     */
    public function testCanDoAdaptedRequestFail()
    {
        $traitMock = $this->getMockForTrait(AdaptsRequestsTrait::class);
        $adapterMock = $this->getDataSourceAdapterMock();

        RequestHelper::fake(static function () {
            throw new Exception('Error sending');
        });

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Error sending');

        $traitMock->doAdaptedRequest($adapterMock);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\AdaptsRequestsTrait::doAdaptedRequest()
     * @throws BaseException
     * @throws Exception
     */
    public function testCanDoAdaptedResponseError()
    {
        $traitMock = $this->getMockForTrait(AdaptsRequestsTrait::class);
        $adapterMock = $this->getDataSourceAdapterMock();

        \WP_Mock::userFunction('is_wp_error')->andReturnTrue();

        RequestHelper::fake(static function () {
            $errorMock = \Mockery::mock('WP_Error');
            $errorMock->shouldReceive('get_error_message')->andReturn('auth error');

            return new Response($errorMock);
        });

        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('auth error');

        $traitMock->doAdaptedRequest($adapterMock);
    }

    private function getDataSourceAdapterMock()
    {
        return new class implements DataSourceAdapterContract {

            public function convertFromSource() : Request
            {
                return new Request();
            }

            public function convertToSource() : array
            {
                return ['some-data'];
            }
        };
    }
}
