<?php

return array(

  /**
   * @var string Numeric Facebook app id, espressed as string
   */
  'app_id' => '525243791549096',

  /**
   * @var string App Secret
   * @see https://developers.facebook.com/apps/<APP_ID>/dashboard/
   */
  'app_secret' => '57bcb17d93cca10a5e600c0558aacfbf',

  /**
   * @var string User Access Token
   * @see https://developers.facebook.com/docs/facebook-login/access-tokens/
   */
  'access_token' => '',

  /**
   * @var string Numeric Facebook Business Manager id, espressed as string
   */
  'business_id' => '',

  /**
   * @var string Numeric Facebook id, preceded by 'act_', espressed as string
   * @see https://www.facebook.com/ads/manage/home/
   */
  'act_id' => '',

  /**
   * @var string PHP timezone compatible with the AdAccount timezone, override php.ini config
   * @see http://php.net/manual/en/timezones.php
   */
  'act_timezone' => '',

  /**
   * @var string Numeric Facebook id, espressed as string
   * @see https://www.facebook.com/ads/manage/home/
   */
  'page_id' => '',

  /**
   * @var string Url of your app [Stream post URL security]
   *             Example: 'http://my.domain.com/'
   * @see https://developers.facebook.com/docs/facebook-login/security/#surfacearea
   */
  'app_url' => '',

  /**
   * @var string Numeric Instagram actor id, espressed as string
   */
  'instagram_actor_id' => '',

  // OPTIONAL INTEGRATION TESTS

  'skip_if' => array(

    /**
     * @var bool Skip tests that require an business manager
     * @see https://developers.facebook.com/docs/marketing-api/businessmanager/
     */
    'no_business_manager' => true,

    /**
     * @var bool Skip tests that require an account with a valid payment method
     * @see https://secure.facebook.com/ads/manage/funding.php
     */
    'no_payment_method' => true,

    /**
     * @var bool Skip tests that require parnet categories whitelisting
     * @see https://developers.facebook.com/docs/reference/ads-api/partnercategories
     */
    'no_partner_categories' => true,

    /**
     * @var bool Skip tests that require video upload
     */
    'no_video_upload' => true,

    /**
     * @var bool Skip tests that require reach and frequency whitelisting
     */
    'no_reach_and_frequency_whitelist' => true,

    /**
     * @var bool Skip tests that require polling for async jobs execution
     */
    'no_async_jobs' => true,

    /**
     * @var bool Skip tests that require an instagram actor
     */
    'no_instagram' => true,
  ),

  // OPTIONAL CONFIGURATIONS

  /**
   * @var string Override Facebook graph domain
   *             Example: try hitting beta.facebook.com
   */
  'graph_base_domain' => '',

  /**
   * @var string Disable SSL verification between CA and host
   *             [Security] Do not change this unless you trust your network
   */
  'skip_ssl_verification' => false,

  /**
   * @var string Filepath to which cUrl shell equivalents will be dumped
   *             Tip: access std streams with 'php://stdout' or 'php://stderr'
   */
  'curl_logger' => '',

  // OPTIONAL SECONDARY ENTITIES
  // Do not set the same as primary. May incurr in lost permissions.

  /**
   * @var string Ausiliary Business ID for permissions and sharing testing
   */
  'secondary_business_id' => '',

  /**
   * @var string Ausiliary Account ID for permissions and sharing testing
   */
  'secondary_account_id' => '',

  /**
   * @var string Ausiliary Page ID for permissions and sharing testing
   */
  'secondary_page_id' => '',

  /**
   * @var string Ausiliary Page ID for permissions and sharing testing
   */
  'secondary_app_id' => '',
);