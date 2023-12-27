<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>New Order #{{ $orderDetails['order'] }}</title>
    </head>
    <body style="margin:0px; background: #e8ebf0;">
        <div style="width:100%;background: #e8ebf0; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #333;">
            <div style="max-width: 700px; padding: 50px 0; margin: 0px auto; font-size: 14px">
                <div style="padding: 30px; background: #fff;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                            <tr><td colspan='4' align="center"><a href="{{ url('/') }}" target="_blank"><img src="{{ asset('FrontEnd/images/logo.png') }}" alt="Marina Azer"/></a></td></tr>
                            <tr><td colspan='4' align="center"><hr/></td></tr>
                            <tr>
                                <td>
                                    <h1 style="color: #24222f; font-size: 20px; font-weight: bold">Order #{{ $orderDetails['order'] }}</h1>
                                    <p>{{ __('A New Order From') }} <a href="{{ url('/') }}" style="color: #be2327; text-decoration: underline;" target="_blank">Marina Azer</a>. <a href='{{ Route('edit-order', $orderDetails['order']) }}'>{{ __('View order Details') }}</a>.</p>
                                    <p>
                                        @php 
                                            $address = App\Models\ShippingAddress::find($orderDetails['shipping_address']); 
                                            $paymentMethod = App\Models\PaymentMethod::find($orderDetails['payment_method']); 
                                        @endphp
                                        {{ ('Address') }} : {{ $address->address }} <br/>
                                        {{ ('Payment Method') }} : {{ $paymentMethod->title }} <br/>
                                        {{ ('Comment') }} : {{ $orderDetails['orderComment'] }}
                                    </p>
                                    <p>{{ __('Customer Order Details') }}:</p>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #eee;">
                                        <tr style="background-color: #eee;">
                                            <td style="text-align: left; padding: 8px 12px;"></td>
                                            <td style="width: 15%; text-align: center; padding: 8px 12px;">{{ __('Product') }}</td>
                                            <td style="width: 15%; text-align: center; padding: 8px 12px;">{{ __('Size') }}</td>
                                            <td style="width: 15%; text-align: center; padding: 8px 12px;">{{ __('Qty') }}</td>
                                            <td style="width: 20%; text-align: right; padding: 8px 12px;">{{ __('Price') }}</td>
                                        </tr>
                                        
                                        @foreach($orderDetails['items'] as $item)
                                        @php $product = App\Models\Product::find($item->product); @endphp
                                        @php $size = App\Models\Size::find($item->size); @endphp
                                        <tr>
                                            <td style="text-align: left; padding: 8px 12px;"><a style="color:#be2327;" href="{{ Route('product-details', ['slug' => $product->Category->slug, 'prodSlug' => $product->slug]) }}" target="_blank">{{ $product->title }}</a></td>
                                            <td style="width: 15%; text-align: center; padding: 8px 12px;">{{ $size->title }}</td>
                                            <td style="width: 15%; text-align: center; padding: 8px 12px;">{{ $item->size }}</td>
                                            <td style="width: 15%; text-align: center; padding: 8px 12px;">{{ $item->qty }}</td>
                                            <td style="width: 20%; text-align: right; padding: 8px 12px;">{{ $item->price }} {{ __('EGP') }}</td>
                                        </tr>
                                        @endforeach
                                        
                                        <tr style="background-color: #eee;">
                                            <td style="text-align: left; padding: 8px 12px;">{{ __('Subtotal') }}</td>
                                            <td colspan="3" style="width: 15%; text-align: center; padding: 8px 12px;">&nbsp;</td>
                                            <td style="width: 20%; text-align: right; padding: 8px 12px;">{{ $orderDetails['total_price'] - $orderDetails['shipping_price'] }} {{ __('EGP') }}</td>
                                        </tr>
                                        
                                        
                                        <tr style="background-color: #eee;">
                                            <td style="text-align: left; padding: 8px 12px;">{{ __('Shipping Fees') }}</td>
                                            <td colspan="3" style="width: 15%; text-align: center; padding: 8px 12px;">&nbsp;</td>
                                            <td style="width: 20%; text-align: right; padding: 8px 12px;">{{ $orderDetails['shipping_price'] }} {{ __('EGP') }}</td>
                                        </tr>
                                        <tr style="background-color: #be2327; color: #fff;">
                                            <td style="text-align: left; padding: 8px 12px;"><span style="font-weight: bold; text-transform: uppercase;">{{ __('Total') }}</span></td>
                                            <td colspan="3" style="width: 15%; text-align: center; padding: 8px 12px;"></td>
                                            <td style="width: 20%; text-align: right; padding: 8px 12px;"><span style="font-weight: bold; white-space: nowrap;">{{ $orderDetails['total_price'] }} {{ __('EGP') }}</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="text-align: center; font-size: 12px; color: #999; margin-top: 20px">
                    Marina Azer - <a style="color:#be2327;" href="https://innovationscope.com" target="_blank">Developed by Innovation Scope</a>
                </div>
            </div>
        </div>
    </body>
</html>