/**
 * Store Setting
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {

        // Initialize Phone number
        let shopPhoneNumber = document.getElementById('phone_number');
        if (shopPhoneNumber) {
            window.Helpers.internationalNumber('#phone_number');
        }

        // Initialize currency and country dropdown with tomSelect
        let shopCurrencyId = document.getElementById('shop_currency_id');
        let shopCountryId = document.getElementById('shop_country_id');
        let countryId = document.getElementById('country_id');
        if (shopCurrencyId) {
            new window.TomSelect(shopCurrencyId, {});
        }
        if (shopCountryId) {
            new window.TomSelect(shopCountryId, {});
        }
        if (countryId) {
            new window.TomSelect(countryId, {});
        }

    })();
});
