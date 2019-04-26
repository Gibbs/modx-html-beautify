<?php
/**
 * XHTML Beautify - Clean up MODx source code output
 *
 * Copyright (c) 2012 Gold Coast Media Ltd
 *
 * This file is part of XHTML Beautify.
 *
 * XHTML Beautify is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * XHTML Beautify is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * XHTML Beautify; if not, write to the Free Software Foundation, Inc., 59
 * Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package  xhtmlbeautify
 * @author   Dan Gibbs <contact@dangibbs.co.uk>
 */

class XhtmlBeautify
{
    /**
    * @var object
    */
    protected $_modx;

    /**
    * @var string
    */
    protected $_namespace = 'xhtmlbeautify.';

    /**
    * @var array
    */
    public $config = array(
        'document'           => true,
        'source'             => null,
        // htmLawed
        'abs_url'            => 0,
        'and_mark'           => 0,
        'anti_link_spam'     => 0,
        'anti_mail_spam'     => 0,
        'balance'            => 0,
        'base_url'           => 3,
        'clean_ms_char'      => 0,
        'comment'            => 3,
        'css_expression'     => 1, // 0
        'deny_attribute'     => 0,
        'direct_nest_list'   => 0,
        'elements'           => '', // *
        'hexdec_entity'      => 1,
        'keep_bad'           => 6,
        'lc_std_val'         => 1,
        'make_tag_strict'    => 0, // 1
        'named_entity'       => 1,
        'no_deprecated_attr' => 0, // 1
        'safe'               => 0,
        'schemes'            => '*:*', // Array
        'style_pass'         => 0,
        'tidy'               => '1t0n',
        'unique_ids'         => 0, // 1
        'valid_xhtml'        => 0,
        'xml:lang'           => 0,
    );

    /**
     * Constructor
     *
     * @param modX  $modx
     * @param array $config
     */
    public function __construct(modX &$modx, array &$config)
    {
        $this->_modx = $modx;
        $modx_config = array();

        // Force all parameters to lowercase
        $config = array_change_key_case($config, CASE_LOWER);

        $settings = $this->_modx->newQuery('modSystemSetting')->where(array('key:LIKE' => $this->_namespace . '%'));
        $settings = $this->_modx->getCollection('modSystemSetting', $settings);

        // Apply MODx manager settings
        foreach($settings as $key => $setting) {
            $key = str_replace($this->_namespace, '', $key);
            $modx_config[$key] = $setting->get('value');
        }

        $config = array_merge($modx_config, $config);
        $this->config = array_merge($this->config, array_filter($config) );
    }

    /**
     * Run the beautifier
     *
     * @return string|void
     */
    public function run()
    {
        $resource = $this->_modx->resource;
        $content_type = $resource->get('contentType');
        $output = null;
        $cache = false;
        $document = $this->config['document'];

        $source = ($this->config['source']) ? $this->config['source'] : $resource->_content;

        // Use the entire document output when uncached
        if($this->config['document']) {
            $output = $this->beautify($resource->_output, $document, $content_type);
            $resource->_output = $output;
        }
        else {
            $output = $this->beautify($source, $document, $content_type);

            return $output;
        }
    }

    /**
     * Filter the source
     *
     * @param  string  $source
     * @param  boolean $document
     * @param  string  $content_type
     * @return string|null
     */
    public function beautify($source = null, $document = true, $content_type = null)
    {
        // Default output
        $output = NULL;

        // Accepted content types
        $types = array(
            'text/html',
            'application/xhtml+xml',
        );

        // Full document
        if($document) {
            // Check if the content type is valid
            $content_type = (in_array($content_type, $types)) ? true : false;
            $less = strtolower(substr(trim($source), 0, 100));

            // Ensure doctype
            if(stripos($less, 'doctype html') !== false) {
                $output = $this->_clean_output($source, $this->config);
            }
        }
        // HTML snippet
        else {
            $output = $this->_clean_output($source, $this->config);
        }

        return $output;
    }

    /**
    * Clean and beautify document output
    *
    * @param   string  $source  source code
    * @param   array   $config  configuration
    * @return  string           processed source
    */
    protected function _clean_output($source = null, $config)
    {
        preg_match('/(<body[^>]*>)(.*?)(<\/body>)/si', $source, $match);

        if( isset($match[2]) ) {
            $body = htmLawed($match[2], $config);
            $output = preg_replace('/(<body[^>]*>)(.*?)(<\/body>)/si', "$1$body$3", $source);

            return $output;
        }
        else {
            return $source;
        }
    }
}
