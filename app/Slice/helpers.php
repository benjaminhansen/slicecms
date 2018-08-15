<?php

use App\Slice\SliceCMS;

function site() {
    return SliceCMS::{__FUNCTION__}();
}

function assigned_theme() {
    return site()->{__FUNCTION__};
}

function themes() {
    return site()->{__FUNCTION__};
}

function organization() {
    return site()->{__FUNCTION__};
}

function settings() {
    return site()->{__FUNCTION__};
}