<?php
/**
 *
 * Copyright (c) 2014 Zishan Ansari
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * Date: 7/26/2015
 * Time: 12:57 AM
 */

/**
 * Returns 'active' if Request is same as current.
 * This function is used to make a nav bar actived when in that page.
 *
 * @param $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : '';

}

function set_active_or_disabled($path, $active = 'active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : 'disabled';

}

function slug_for_url($first, $second=null)
{
   return str_slug(str_limit($first, 50, $second), '-');
}

function pre_content_filter( $content ) {
    return preg_replace_callback( '|<pre.*>(.*)</pre|isU' , 'convert_pre_entities', $content );
}

function convert_pre_entities( $matches ) {
    return str_replace( $matches[1], html_entity_decode( $matches[1] ), $matches[0] );
}

function render_markdown_for_view($string)
{
    return pre_content_filter(Markdown::string(htmlentities($string)));
}