# OpenAPI\Client\DefaultApi

All URIs are relative to http://localhost:8000/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**orderPost()**](DefaultApi.md#orderPost) | **POST** /order | Crea una nova comanda i genera la sessió de pagament |
| [**productsGet()**](DefaultApi.md#productsGet) | **GET** /products | Llista tots els productes |
| [**productsIdGet()**](DefaultApi.md#productsIdGet) | **GET** /products/{id} | Obté el detall d&#39;un producte |


## `orderPost()`

```php
orderPost($order_post_request)
```

Crea una nova comanda i genera la sessió de pagament

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_post_request = new \OpenAPI\Client\Model\OrderPostRequest(); // \OpenAPI\Client\Model\OrderPostRequest

try {
    $apiInstance->orderPost($order_post_request);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_post_request** | [**\OpenAPI\Client\Model\OrderPostRequest**](../Model/OrderPostRequest.md)|  | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `productsGet()`

```php
productsGet(): \OpenAPI\Client\Model\ProductsGet200ResponseInner[]
```

Llista tots els productes

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->productsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->productsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\ProductsGet200ResponseInner[]**](../Model/ProductsGet200ResponseInner.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `productsIdGet()`

```php
productsIdGet($id)
```

Obté el detall d'un producte

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string

try {
    $apiInstance->productsIdGet($id);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->productsIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
