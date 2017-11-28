@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div id="customer_panel">
        <h3>User Panel</h3>
        <div class="panel_block">
            <h3>Your BillingAddress data</h3>
            @if (session('success1'))
                <div class="success-message">
                    {{ session('success1') }}
                </div>
            @endif
            @if (!empty($errors))
                <div class="validation_error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login-form" role="form" method="POST" action="{{ route('save-customer-address') }}">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="1">
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="First Name" name="first_name"
                               value="{{ !empty($billingAddress) ? $billingAddress->first_name : '' }}" required="required">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Last Name" name="last_name" value="{{ !empty($billingAddress) ? $billingAddress->last_name : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="email" placeholder="Email" name="email"  value="{{ !empty($billingAddress) ? $billingAddress->email : '' }}">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Phone Number" name="phone_number" value="{{ !empty($billingAddress) ? $billingAddress->phone_number : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_full">
                        <input tabindex="1" class="input-form" type="text" placeholder="Street" name="street" value="{{ !empty($billingAddress) ? $billingAddress->street : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="House Number" name="house_number" value="{{ !empty($billingAddress) ? $billingAddress->house_number : '' }}">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Door Number" name="door_number" value="{{ !empty($billingAddress) ? $billingAddress->door_number : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="City" name="city" value="{{ !empty($billingAddress) ? $billingAddress->city : '' }}">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Post Code" name="zipcode" value="{{ !empty($billingAddress) ? $billingAddress->zipcode : '' }}" required="required">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_full">
                        <select name="country_id" required="required">
                            <option value="">--Select--</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ !empty($billingAddress) && $billingAddress->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <button class="submit-btn button">Change</button>
            </form>
        </div>
        <div class="panel_block">
            <h3>Your Shipping Address data</h3>
            @if (session('success2'))
                <div class="success-message">
                    {{ session('success2') }}
                </div>
            @endif
            <form class="login-form" role="form" method="POST" action="{{ route('save-customer-address') }}">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="2">
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="First Name" name="first_name"
                               value="{{ !empty($shippingAddress) ? $shippingAddress->first_name : '' }}" required="required">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Last Name" name="last_name" value="{{ !empty($shippingAddress) ? $shippingAddress->last_name : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="email" placeholder="Email" name="email"  value="{{ !empty($shippingAddress) ? $shippingAddress->email : '' }}">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Phone Number" name="phone_number" value="{{ !empty($shippingAddress) ? $shippingAddress->phone_number : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_full">
                        <input tabindex="1" class="input-form" type="text" placeholder="Street" name="street" value="{{ !empty($shippingAddress) ? $shippingAddress->street : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="House Number" name="house_number" value="{{ !empty($shippingAddress) ? $shippingAddress->house_number : '' }}">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Door Number" name="door_number" value="{{ !empty($shippingAddress) ? $shippingAddress->door_number : '' }}">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="City" name="city" value="{{ !empty($shippingAddress) ? $shippingAddress->city : '' }}">
                    </div>
                    <div class="input_holder_half">
                        <input tabindex="1" class="input-form" type="text" placeholder="Post Code" name="zipcode" value="{{ !empty($shippingAddress) ? $shippingAddress->zipcode : '' }}" required="required">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_full">
                        <select name="country_id" required="required">
                            <option value="">--Select--</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ !empty($shippingAddress) && $shippingAddress->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <button class="submit-btn button">Change</button>
            </form>
        </div>
        <div class="panel_block">
            <h3>Change Password</h3>
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif
            <form class="login-form" role="form" method="POST" action="{{ route('change-password-action') }}">
                {{ csrf_field() }}
                <div class="input_holder">
                    <div class="input_holder_full">
                        <input tabindex="1" class="input-form" type="password" name="current_password" placeholder="Enter your current password">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_full">
                        <input tabindex="2" class="input-form" type="password" name="new_password" placeholder="Enter your new password">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="input_holder">
                    <div class="input_holder_full">
                        <input tabindex="3" class="input-form" type="password" name="password_confirmation" placeholder="Repeat your new password">
                    </div>
                    <div class="clear"></div>
                </div>
                <button class="submit-btn button">Change your password</button>
            </form>

        </div>

        <div class="panel_block">
            <h3>Your Payment</h3>
            <div class="payment_Holder">
                <table id="t01">
                    <tr>
                        <th>Pending Payments</th>
                        <th>Approved Payments </th>
                    </tr>
                    <tr>
                        <td>$. 0</td>
                        <td>$. 386</td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="clear"></div>
        <div class="panel_block_full">
            <h3>List Of order</h3>
            <div class="transactionList">
                <table>
                    <tbody>
                    <tr>
                        <th>Order Transaction</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td data-th="Transaction">Lorem ipsum <a href="javascript:void(0);">dolor sit amet</a>, consectetur <a href="javascript:void(0);">adipiscing elit. Maecenas</a> sed leo urna.
                            <div class="order_Tdate">23rd april , 2017</div>
                        </td>
                        <td data-th="Amount">$ 216.00
                            <div class="toolTip"> <i class="fa fa-question-circle"></i>
                                <div class="tooltipDesc"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>
                            </div>
                        </td>
                        <td data-th="Amount">
                            <a href="">View Order</a>
                        </td>
                    </tr>
                    <tr>
                        <td data-th="Transaction">Lorem ipsum <a href="javascript:void(0);">dolor sit amet</a>, consectetur <a href="javascript:void(0);">adipiscing elit. Maecenas</a> sed leo urna.
                            <div class="order_Tdate">23rd april , 2017</div>

                        </td>
                        <td data-th="Amount">$ 216.00
                            <div class="toolTip"> <i class="fa fa-question-circle"></i>
                                <div class="tooltipDesc"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>
                            </div>
                        </td>
                        <td data-th="Amount">
                            <a href="">View Order</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
@endsection