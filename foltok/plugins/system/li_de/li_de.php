<?php

// No direct access

// system li-de plugin

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

// browser detect ==================================================================
class Browser
{
    private $_agent = '';
    private $_browser_name = '';
    private $_version = '';
    private $_platform = '';
    private $_os = '';
    private $_is_aol = false;
    private $_is_mobile = false;
    private $_is_tablet = false;
    private $_is_robot = false;
    private $_is_facebook = false;
    private $_aol_version = '';

    const BROWSER_UNKNOWN = 'unknown';
    const VERSION_UNKNOWN = 'unknown';

    const BROWSER_OPERA = 'Opera'; // http://www.opera.com/
    const BROWSER_OPERA_MINI = 'Opera Mini'; // http://www.opera.com/mini/
    const BROWSER_WEBTV = 'WebTV'; // http://www.webtv.net/pc/
    const BROWSER_IE = 'Internet Explorer'; // http://www.microsoft.com/ie/
    const BROWSER_POCKET_IE = 'Pocket Internet Explorer'; // http://en.wikipedia.org/wiki/Internet_Explorer_Mobile
    const BROWSER_KONQUEROR = 'Konqueror'; // http://www.konqueror.org/
    const BROWSER_ICAB = 'iCab'; // http://www.icab.de/
    const BROWSER_OMNIWEB = 'OmniWeb'; // http://www.omnigroup.com/applications/omniweb/
    const BROWSER_FIREBIRD = 'Firebird'; // http://www.ibphoenix.com/
    const BROWSER_FIREFOX = 'Firefox'; // http://www.mozilla.com/en-US/firefox/firefox.html
    const BROWSER_ICEWEASEL = 'Iceweasel'; // http://www.geticeweasel.org/
    const BROWSER_SHIRETOKO = 'Shiretoko'; // http://wiki.mozilla.org/Projects/shiretoko
    const BROWSER_MOZILLA = 'Mozilla'; // http://www.mozilla.com/en-US/
    const BROWSER_AMAYA = 'Amaya'; // http://www.w3.org/Amaya/
    const BROWSER_LYNX = 'Lynx'; // http://en.wikipedia.org/wiki/Lynx
    const BROWSER_SAFARI = 'Safari'; // http://apple.com
    const BROWSER_IPHONE = 'iPhone'; // http://apple.com
    const BROWSER_IPOD = 'iPod'; // http://apple.com
    const BROWSER_IPAD = 'iPad'; // http://apple.com
    const BROWSER_CHROME = 'Chrome'; // http://www.google.com/chrome
    const BROWSER_ANDROID = 'Android'; // http://www.android.com/
    const BROWSER_GOOGLEBOT = 'GoogleBot'; // http://en.wikipedia.org/wiki/Googlebot
    const BROWSER_SLURP = 'Yahoo! Slurp'; // http://en.wikipedia.org/wiki/Yahoo!_Slurp
    const BROWSER_W3CVALIDATOR = 'W3C Validator'; // http://validator.w3.org/
    const BROWSER_BLACKBERRY = 'BlackBerry'; // http://www.blackberry.com/
    const BROWSER_ICECAT = 'IceCat'; // http://en.wikipedia.org/wiki/GNU_IceCat
    const BROWSER_NOKIA_S60 = 'Nokia S60 OSS Browser'; // http://en.wikipedia.org/wiki/Web_Browser_for_S60
    const BROWSER_NOKIA = 'Nokia Browser'; // * all other WAP-based browsers on the Nokia Platform
    const BROWSER_MSN = 'MSN Browser'; // http://explorer.msn.com/
    const BROWSER_MSNBOT = 'MSN Bot'; // http://search.msn.com/msnbot.htm
    const BROWSER_BINGBOT = 'Bing Bot'; // http://en.wikipedia.org/wiki/Bingbot

    const BROWSER_NETSCAPE_NAVIGATOR = 'Netscape Navigator'; // http://browser.netscape.com/ (DEPRECATED)
    const BROWSER_GALEON = 'Galeon'; // http://galeon.sourceforge.net/ (DEPRECATED)
    const BROWSER_NETPOSITIVE = 'NetPositive'; // http://en.wikipedia.org/wiki/NetPositive (DEPRECATED)
    const BROWSER_PHOENIX = 'Phoenix'; // http://en.wikipedia.org/wiki/History_of_Mozilla_Firefox (DEPRECATED)

    const PLATFORM_UNKNOWN = 'unknown';
    const PLATFORM_WINDOWS = 'Windows';
    const PLATFORM_WINDOWS_CE = 'Windows CE';
    const PLATFORM_APPLE = 'Apple';
    const PLATFORM_LINUX = 'Linux';
    const PLATFORM_OS2 = 'OS/2';
    const PLATFORM_BEOS = 'BeOS';
    const PLATFORM_IPHONE = 'iPhone';
    const PLATFORM_IPOD = 'iPod';
    const PLATFORM_IPAD = 'iPad';
    const PLATFORM_BLACKBERRY = 'BlackBerry';
    const PLATFORM_NOKIA = 'Nokia';
    const PLATFORM_FREEBSD = 'FreeBSD';
    const PLATFORM_OPENBSD = 'OpenBSD';
    const PLATFORM_NETBSD = 'NetBSD';
    const PLATFORM_SUNOS = 'SunOS';
    const PLATFORM_OPENSOLARIS = 'OpenSolaris';
    const PLATFORM_ANDROID = 'Android';

    const OPERATING_SYSTEM_UNKNOWN = 'unknown';

    public function Browser($userAgent = "")
    {
        $this->reset();
        if ($userAgent != "") {
            $this->setUserAgent($userAgent);
        } else {
            $this->determine();
        }
    }

    /**
     * Reset all properties
     */
    public function reset()
    {
        $this->_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
        $this->_browser_name = self::BROWSER_UNKNOWN;
        $this->_version = self::VERSION_UNKNOWN;
        $this->_platform = self::PLATFORM_UNKNOWN;
        $this->_os = self::OPERATING_SYSTEM_UNKNOWN;
        $this->_is_aol = false;
        $this->_is_mobile = false;
        $this->_is_tablet = false;
        $this->_is_robot = false;
        $this->_is_facebook = false;
        $this->_aol_version = self::VERSION_UNKNOWN;
    }

    /**
     * Check to see if the specific browser is valid
     * @param string $browserName
     * @return bool True if the browser is the specified browser
     */
    function isBrowser($browserName)
    {
        return (0 == strcasecmp($this->_browser_name, trim($browserName)));
    }

    /**
     * The name of the browser.  All return types are from the class contants
     * @return string Name of the browser
     */
    public function getBrowser()
    {
        return $this->_browser_name;
    }

    /**
     * Set the name of the browser
     * @param $browser string The name of the Browser
     */
    public function setBrowser($browser)
    {
        $this->_browser_name = $browser;
    }

    /**
     * The name of the platform.  All return types are from the class contants
     * @return string Name of the browser
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     * Set the name of the platform
     * @param string $platform The name of the Platform
     */
    public function setPlatform($platform)
    {
        $this->_platform = $platform;
    }

    /**
     * The version of the browser.
     * @return string Version of the browser (will only contain alpha-numeric characters and a period)
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Set the version of the browser
     * @param string $version The version of the Browser
     */
    public function setVersion($version)
    {
        $this->_version = preg_replace('/[^0-9,.,a-z,A-Z-]/', '', $version);
    }

    /**
     * The version of AOL.
     * @return string Version of AOL (will only contain alpha-numeric characters and a period)
     */
    public function getAolVersion()
    {
        return $this->_aol_version;
    }

    /**
     * Set the version of AOL
     * @param string $version The version of AOL
     */
    public function setAolVersion($version)
    {
        $this->_aol_version = preg_replace('/[^0-9,.,a-z,A-Z]/', '', $version);
    }

    /**
     * Is the browser from AOL?
     * @return boolean True if the browser is from AOL otherwise false
     */
    public function isAol()
    {
        return $this->_is_aol;
    }

    /**
     * Is the browser from a mobile device?
     * @return boolean True if the browser is from a mobile device otherwise false
     */
    public function isMobile()
    {
        return $this->_is_mobile;
    }

    /**
     * Is the browser from a tablet device?
     * @return boolean True if the browser is from a tablet device otherwise false
     */
    public function isTablet()
    {
        return $this->_is_tablet;
    }

    /**
     * Is the browser from a robot (ex Slurp,GoogleBot)?
     * @return boolean True if the browser is from a robot otherwise false
     */
    public function isRobot()
    {
        return $this->_is_robot;
    }

    /**
    * Is the browser from facebook?
    * @return boolean True if the browser is from facebook otherwise false
    */
    public function isFacebook() 
    { 
        return $this->_is_facebook;
    }

    /**
     * Set the browser to be from AOL
     * @param $isAol
     */
    public function setAol($isAol)
    {
        $this->_is_aol = $isAol;
    }

    /**
     * Set the Browser to be mobile
     * @param boolean $value is the browser a mobile browser or not
     */
    protected function setMobile($value = true)
    {
        $this->_is_mobile = $value;
    }

    /**
     * Set the Browser to be tablet
     * @param boolean $value is the browser a tablet browser or not
     */
    protected function setTablet($value = true)
    {
        $this->_is_tablet = $value;
    }

    /**
     * Set the Browser to be a robot
     * @param boolean $value is the browser a robot or not
     */
    protected function setRobot($value = true)
    {
        $this->_is_robot = $value;
    }

    /**
     * Set the Browser to be a Facebook request
     * @param boolean $value is the browser a robot or not
     */
    protected function setFacebook($value = true) 
    { 
        $this->_is_facebook = $value; 
    }

    /**
     * Get the user agent value in use to determine the browser
     * @return string The user agent from the HTTP header
     */
    public function getUserAgent()
    {
        return $this->_agent;
    }

    /**
     * Set the user agent value (the construction will use the HTTP header value - this will overwrite it)
     * @param string $agent_string The value for the User Agent
     */
    public function setUserAgent($agent_string)
    {
        $this->reset();
        $this->_agent = $agent_string;
        $this->determine();
    }

    /**
     * Used to determine if the browser is actually "chromeframe"
     * @since 1.7
     * @return boolean True if the browser is using chromeframe
     */
    public function isChromeFrame()
    {
        return (strpos($this->_agent, "chromeframe") !== false);
    }

    /**
     * Returns a formatted string with a summary of the details of the browser.
     * @return string formatted string with a summary of the browser
     */
    public function __toString()
    {
        return "<strong>Browser Name:</strong> {$this->getBrowser()}<br/>\n" .
        "<strong>Browser Version:</strong> {$this->getVersion()}<br/>\n" .
        "<strong>Browser User Agent String:</strong> {$this->getUserAgent()}<br/>\n" .
        "<strong>Platform:</strong> {$this->getPlatform()}<br/>";
    }

    /**
     * Protected routine to calculate and determine what the browser is in use (including platform)
     */
    protected function determine()
    {
        $this->checkPlatform();
        $this->checkBrowsers();
        $this->checkForAol();
    }

    /**
     * Protected routine to determine the browser type
     * @return boolean True if the browser was detected otherwise false
     */
    protected function checkBrowsers()
    {
        return (
            // well-known, well-used
            // Special Notes:
            // (1) Opera must be checked before FireFox due to the odd
            //     user agents used in some older versions of Opera
            // (2) WebTV is strapped onto Internet Explorer so we must
            //     check for WebTV before IE
            // (3) (deprecated) Galeon is based on Firefox and needs to be
            //     tested before Firefox is tested
            // (4) OmniWeb is based on Safari so OmniWeb check must occur
            //     before Safari
            // (5) Netscape 9+ is based on Firefox so Netscape checks
            //     before FireFox are necessary
            $this->checkBrowserWebTv() ||
            $this->checkBrowserInternetExplorer() ||
            $this->checkBrowserOpera() ||
            $this->checkBrowserGaleon() ||
            $this->checkBrowserNetscapeNavigator9Plus() ||
            $this->checkBrowserFirefox() ||
            $this->checkBrowserChrome() ||
            $this->checkBrowserOmniWeb() ||

            // common mobile
            $this->checkBrowserAndroid() ||
            $this->checkBrowseriPad() ||
            $this->checkBrowseriPod() ||
            $this->checkBrowseriPhone() ||
            $this->checkBrowserBlackBerry() ||
            $this->checkBrowserNokia() ||

            // common bots
            $this->checkBrowserGoogleBot() ||
            $this->checkBrowserMSNBot() ||
            $this->checkBrowserBingBot() ||
            $this->checkBrowserSlurp() ||

            // check for facebook external hit when loading URL
            $this->checkFacebookExternalHit() ||

            // WebKit base check (post mobile and others)
            $this->checkBrowserSafari() ||

            // everyone else
            $this->checkBrowserNetPositive() ||
            $this->checkBrowserFirebird() ||
            $this->checkBrowserKonqueror() ||
            $this->checkBrowserIcab() ||
            $this->checkBrowserPhoenix() ||
            $this->checkBrowserAmaya() ||
            $this->checkBrowserLynx() ||
            $this->checkBrowserShiretoko() ||
            $this->checkBrowserIceCat() ||
            $this->checkBrowserIceweasel() || 
            $this->checkBrowserW3CValidator() ||
            $this->checkBrowserMozilla() /* Mozilla is such an open standard that you must check it last */
        );
    }

    /**
     * Determine if the user is using a BlackBerry (last updated 1.7)
     * @return boolean True if the browser is the BlackBerry browser otherwise false
     */
    protected function checkBrowserBlackBerry()
    {
        if (stripos($this->_agent, 'blackberry') !== false) {
            $aresult = explode("/", stristr($this->_agent, "BlackBerry"));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->_browser_name = self::BROWSER_BLACKBERRY;
                $this->setMobile(true);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user is using an AOL User Agent (last updated 1.7)
     * @return boolean True if the browser is from AOL otherwise false
     */
    protected function checkForAol()
    {
        $this->setAol(false);
        $this->setAolVersion(self::VERSION_UNKNOWN);

        if (stripos($this->_agent, 'aol') !== false) {
            $aversion = explode(' ', stristr($this->_agent, 'AOL'));
            if (isset($aversion[1])) {
                $this->setAol(true);
                $this->setAolVersion(preg_replace('/[^0-9\.a-z]/i', '', $aversion[1]));
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is the GoogleBot or not (last updated 1.7)
     * @return boolean True if the browser is the GoogletBot otherwise false
     */
    protected function checkBrowserGoogleBot()
    {
        if (stripos($this->_agent, 'googlebot') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'googlebot'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion(str_replace(';', '', $aversion[0]));
                $this->_browser_name = self::BROWSER_GOOGLEBOT;
                $this->setRobot(true);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is the MSNBot or not (last updated 1.9)
     * @return boolean True if the browser is the MSNBot otherwise false
     */
    protected function checkBrowserMSNBot()
    {
        if (stripos($this->_agent, "msnbot") !== false) {
            $aresult = explode("/", stristr($this->_agent, "msnbot"));
            if (isset($aresult[1])) {
                $aversion = explode(" ", $aresult[1]);
                $this->setVersion(str_replace(";", "", $aversion[0]));
                $this->_browser_name = self::BROWSER_MSNBOT;
                $this->setRobot(true);
                return true;
            }
        }
        return false;
    }
    
    /**
     * Determine if the browser is the BingBot or not (last updated 1.9)
     * @return boolean True if the browser is the BingBot otherwise false
     */
    protected function checkBrowserBingBot()
    {
        if (stripos($this->_agent, "bingbot") !== false) {
            $aresult = explode("/", stristr($this->_agent, "bingbot"));
            if (isset($aresult[1])) {
                $aversion = explode(" ", $aresult[1]);
                $this->setVersion(str_replace(";", "", $aversion[0]));
                $this->_browser_name = self::BROWSER_BINGBOT;
                $this->setRobot(true);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is the W3C Validator or not (last updated 1.7)
     * @return boolean True if the browser is the W3C Validator otherwise false
     */
    protected function checkBrowserW3CValidator()
    {
        if (stripos($this->_agent, 'W3C-checklink') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'W3C-checklink'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->_browser_name = self::BROWSER_W3CVALIDATOR;
                return true;
            }
        } else if (stripos($this->_agent, 'W3C_Validator') !== false) {
            // Some of the Validator versions do not delineate w/ a slash - add it back in
            $ua = str_replace("W3C_Validator ", "W3C_Validator/", $this->_agent);
            $aresult = explode('/', stristr($ua, 'W3C_Validator'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->_browser_name = self::BROWSER_W3CVALIDATOR;
                return true;
            }
        } else if (stripos($this->_agent, 'W3C-mobileOK') !== false) {
            $this->_browser_name = self::BROWSER_W3CVALIDATOR;
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is the Yahoo! Slurp Robot or not (last updated 1.7)
     * @return boolean True if the browser is the Yahoo! Slurp Robot otherwise false
     */
    protected function checkBrowserSlurp()
    {
        if (stripos($this->_agent, 'slurp') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Slurp'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->_browser_name = self::BROWSER_SLURP;
                $this->setRobot(true);
                $this->setMobile(false);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Internet Explorer or not (last updated 1.7)
     * @return boolean True if the browser is Internet Explorer otherwise false
     */
    protected function checkBrowserInternetExplorer()
    {
	//  Test for IE11
	if( stripos($this->_agent,'Trident/7.0; rv:11.0') !== false ) {
		$this->setBrowser(self::BROWSER_IE);
		$this->setVersion('11.0');
		return true;
	}
        // Test for v1 - v1.5 IE
        else if (stripos($this->_agent, 'microsoft internet explorer') !== false) {
            $this->setBrowser(self::BROWSER_IE);
            $this->setVersion('1.0');
            $aresult = stristr($this->_agent, '/');
            if (preg_match('/308|425|426|474|0b1/i', $aresult)) {
                $this->setVersion('1.5');
            }
            return true;
        } // Test for versions > 1.5
        else if (stripos($this->_agent, 'msie') !== false && stripos($this->_agent, 'opera') === false) {
            // See if the browser is the odd MSN Explorer
            if (stripos($this->_agent, 'msnb') !== false) {
                $aresult = explode(' ', stristr(str_replace(';', '; ', $this->_agent), 'MSN'));
                if (isset($aresult[1])) {
                    $this->setBrowser(self::BROWSER_MSN);
                    $this->setVersion(str_replace(array('(', ')', ';'), '', $aresult[1]));
                    return true;
                }
            }
            $aresult = explode(' ', stristr(str_replace(';', '; ', $this->_agent), 'msie'));
            if (isset($aresult[1])) {
                $this->setBrowser(self::BROWSER_IE);
                $this->setVersion(str_replace(array('(', ')', ';'), '', $aresult[1]));
                if(stripos($this->_agent, 'IEMobile') !== false) {
                    $this->setBrowser(self::BROWSER_POCKET_IE);
                    $this->setMobile(true);
                }
                return true;
            }
        } // Test for versions > IE 10
		else if(stripos($this->_agent, 'trident') !== false) {
			$this->setBrowser(self::BROWSER_IE);
			$result = explode('rv:', $this->_agent);
            if (isset($result[1])) {
                $this->setVersion(preg_replace('/[^0-9.]+/', '', $result[1]));
                $this->_agent = str_replace(array("Mozilla", "Gecko"), "MSIE", $this->_agent);
            }
		} // Test for Pocket IE
        else if (stripos($this->_agent, 'mspie') !== false || stripos($this->_agent, 'pocket') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'mspie'));
            if (isset($aresult[1])) {
                $this->setPlatform(self::PLATFORM_WINDOWS_CE);
                $this->setBrowser(self::BROWSER_POCKET_IE);
                $this->setMobile(true);

                if (stripos($this->_agent, 'mspie') !== false) {
                    $this->setVersion($aresult[1]);
                } else {
                    $aversion = explode('/', $this->_agent);
                    if (isset($aversion[1])) {
                        $this->setVersion($aversion[1]);
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Opera or not (last updated 1.7)
     * @return boolean True if the browser is Opera otherwise false
     */
    protected function checkBrowserOpera()
    {
        if (stripos($this->_agent, 'opera mini') !== false) {
            $resultant = stristr($this->_agent, 'opera mini');
            if (preg_match('/\//', $resultant)) {
                $aresult = explode('/', $resultant);
                if (isset($aresult[1])) {
                    $aversion = explode(' ', $aresult[1]);
                    $this->setVersion($aversion[0]);
                }
            } else {
                $aversion = explode(' ', stristr($resultant, 'opera mini'));
                if (isset($aversion[1])) {
                    $this->setVersion($aversion[1]);
                }
            }
            $this->_browser_name = self::BROWSER_OPERA_MINI;
            $this->setMobile(true);
            return true;
        } else if (stripos($this->_agent, 'opera') !== false) {
            $resultant = stristr($this->_agent, 'opera');
            if (preg_match('/Version\/(1*.*)$/', $resultant, $matches)) {
                $this->setVersion($matches[1]);
            } else if (preg_match('/\//', $resultant)) {
                $aresult = explode('/', str_replace("(", " ", $resultant));
                if (isset($aresult[1])) {
                    $aversion = explode(' ', $aresult[1]);
                    $this->setVersion($aversion[0]);
                }
            } else {
                $aversion = explode(' ', stristr($resultant, 'opera'));
                $this->setVersion(isset($aversion[1]) ? $aversion[1] : "");
            }
            if (stripos($this->_agent, 'Opera Mobi') !== false) {
                $this->setMobile(true);
            }
            $this->_browser_name = self::BROWSER_OPERA;
            return true;
        } else if (stripos($this->_agent, 'OPR') !== false) {
            $resultant = stristr($this->_agent, 'OPR');
            if (preg_match('/\//', $resultant)) {
                $aresult = explode('/', str_replace("(", " ", $resultant));
                if (isset($aresult[1])) {
                    $aversion = explode(' ', $aresult[1]);
                    $this->setVersion($aversion[0]);
                }
            }
            if (stripos($this->_agent, 'Mobile') !== false) {
                $this->setMobile(true);
            }
            $this->_browser_name = self::BROWSER_OPERA;
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Chrome or not (last updated 1.7)
     * @return boolean True if the browser is Chrome otherwise false
     */
    protected function checkBrowserChrome()
    {
        if (stripos($this->_agent, 'Chrome') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Chrome'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->setBrowser(self::BROWSER_CHROME);
                //Chrome on Android
                if (stripos($this->_agent, 'Android') !== false) {
                    if (stripos($this->_agent, 'Mobile') !== false) {
                        $this->setMobile(true);
                    } else {
                        $this->setTablet(true);
                    }
                }
                return true;
            }
        }
        return false;
    }


    /**
     * Determine if the browser is WebTv or not (last updated 1.7)
     * @return boolean True if the browser is WebTv otherwise false
     */
    protected function checkBrowserWebTv()
    {
        if (stripos($this->_agent, 'webtv') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'webtv'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->setBrowser(self::BROWSER_WEBTV);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is NetPositive or not (last updated 1.7)
     * @return boolean True if the browser is NetPositive otherwise false
     */
    protected function checkBrowserNetPositive()
    {
        if (stripos($this->_agent, 'NetPositive') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'NetPositive'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion(str_replace(array('(', ')', ';'), '', $aversion[0]));
                $this->setBrowser(self::BROWSER_NETPOSITIVE);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Galeon or not (last updated 1.7)
     * @return boolean True if the browser is Galeon otherwise false
     */
    protected function checkBrowserGaleon()
    {
        if (stripos($this->_agent, 'galeon') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'galeon'));
            $aversion = explode('/', $aresult[0]);
            if (isset($aversion[1])) {
                $this->setVersion($aversion[1]);
                $this->setBrowser(self::BROWSER_GALEON);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Konqueror or not (last updated 1.7)
     * @return boolean True if the browser is Konqueror otherwise false
     */
    protected function checkBrowserKonqueror()
    {
        if (stripos($this->_agent, 'Konqueror') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'Konqueror'));
            $aversion = explode('/', $aresult[0]);
            if (isset($aversion[1])) {
                $this->setVersion($aversion[1]);
                $this->setBrowser(self::BROWSER_KONQUEROR);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is iCab or not (last updated 1.7)
     * @return boolean True if the browser is iCab otherwise false
     */
    protected function checkBrowserIcab()
    {
        if (stripos($this->_agent, 'icab') !== false) {
            $aversion = explode(' ', stristr(str_replace('/', ' ', $this->_agent), 'icab'));
            if (isset($aversion[1])) {
                $this->setVersion($aversion[1]);
                $this->setBrowser(self::BROWSER_ICAB);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is OmniWeb or not (last updated 1.7)
     * @return boolean True if the browser is OmniWeb otherwise false
     */
    protected function checkBrowserOmniWeb()
    {
        if (stripos($this->_agent, 'omniweb') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'omniweb'));
            $aversion = explode(' ', isset($aresult[1]) ? $aresult[1] : "");
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_OMNIWEB);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Phoenix or not (last updated 1.7)
     * @return boolean True if the browser is Phoenix otherwise false
     */
    protected function checkBrowserPhoenix()
    {
        if (stripos($this->_agent, 'Phoenix') !== false) {
            $aversion = explode('/', stristr($this->_agent, 'Phoenix'));
            if (isset($aversion[1])) {
                $this->setVersion($aversion[1]);
                $this->setBrowser(self::BROWSER_PHOENIX);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Firebird or not (last updated 1.7)
     * @return boolean True if the browser is Firebird otherwise false
     */
    protected function checkBrowserFirebird()
    {
        if (stripos($this->_agent, 'Firebird') !== false) {
            $aversion = explode('/', stristr($this->_agent, 'Firebird'));
            if (isset($aversion[1])) {
                $this->setVersion($aversion[1]);
                $this->setBrowser(self::BROWSER_FIREBIRD);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Netscape Navigator 9+ or not (last updated 1.7)
     * NOTE: (http://browser.netscape.com/ - Official support ended on March 1st, 2008)
     * @return boolean True if the browser is Netscape Navigator 9+ otherwise false
     */
    protected function checkBrowserNetscapeNavigator9Plus()
    {
        if (stripos($this->_agent, 'Firefox') !== false && preg_match('/Navigator\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_NETSCAPE_NAVIGATOR);
            return true;
        } else if (stripos($this->_agent, 'Firefox') === false && preg_match('/Netscape6?\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_NETSCAPE_NAVIGATOR);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Shiretoko or not (https://wiki.mozilla.org/Projects/shiretoko) (last updated 1.7)
     * @return boolean True if the browser is Shiretoko otherwise false
     */
    protected function checkBrowserShiretoko()
    {
        if (stripos($this->_agent, 'Mozilla') !== false && preg_match('/Shiretoko\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_SHIRETOKO);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Ice Cat or not (http://en.wikipedia.org/wiki/GNU_IceCat) (last updated 1.7)
     * @return boolean True if the browser is Ice Cat otherwise false
     */
    protected function checkBrowserIceCat()
    {
        if (stripos($this->_agent, 'Mozilla') !== false && preg_match('/IceCat\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_ICECAT);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Nokia or not (last updated 1.7)
     * @return boolean True if the browser is Nokia otherwise false
     */
    protected function checkBrowserNokia()
    {
        if (preg_match("/Nokia([^\/]+)\/([^ SP]+)/i", $this->_agent, $matches)) {
            $this->setVersion($matches[2]);
            if (stripos($this->_agent, 'Series60') !== false || strpos($this->_agent, 'S60') !== false) {
                $this->setBrowser(self::BROWSER_NOKIA_S60);
            } else {
                $this->setBrowser(self::BROWSER_NOKIA);
            }
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Firefox or not (last updated 1.7)
     * @return boolean True if the browser is Firefox otherwise false
     */
    protected function checkBrowserFirefox()
    {
        if (stripos($this->_agent, 'safari') === false) {
            if (preg_match("/Firefox[\/ \(]([^ ;\)]+)/i", $this->_agent, $matches)) {
                $this->setVersion($matches[1]);
                $this->setBrowser(self::BROWSER_FIREFOX);
                //Firefox on Android
                if (stripos($this->_agent, 'Android') !== false) {
                    if (stripos($this->_agent, 'Mobile') !== false) {
                        $this->setMobile(true);
                    } else {
                        $this->setTablet(true);
                    }
                }
                return true;
            } else if (preg_match("/Firefox$/i", $this->_agent, $matches)) {
                $this->setVersion("");
                $this->setBrowser(self::BROWSER_FIREFOX);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Firefox or not (last updated 1.7)
     * @return boolean True if the browser is Firefox otherwise false
     */
    protected function checkBrowserIceweasel()
    {
        if (stripos($this->_agent, 'Iceweasel') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Iceweasel'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->setBrowser(self::BROWSER_ICEWEASEL);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Mozilla or not (last updated 1.7)
     * @return boolean True if the browser is Mozilla otherwise false
     */
    protected function checkBrowserMozilla()
    {
        if (stripos($this->_agent, 'mozilla') !== false && preg_match('/rv:[0-9].[0-9][a-b]?/i', $this->_agent) && stripos($this->_agent, 'netscape') === false) {
            $aversion = explode(' ', stristr($this->_agent, 'rv:'));
            preg_match('/rv:[0-9].[0-9][a-b]?/i', $this->_agent, $aversion);
            $this->setVersion(str_replace('rv:', '', $aversion[0]));
            $this->setBrowser(self::BROWSER_MOZILLA);
            return true;
        } else if (stripos($this->_agent, 'mozilla') !== false && preg_match('/rv:[0-9]\.[0-9]/i', $this->_agent) && stripos($this->_agent, 'netscape') === false) {
            $aversion = explode('', stristr($this->_agent, 'rv:'));
            $this->setVersion(str_replace('rv:', '', $aversion[0]));
            $this->setBrowser(self::BROWSER_MOZILLA);
            return true;
        } else if (stripos($this->_agent, 'mozilla') !== false && preg_match('/mozilla\/([^ ]*)/i', $this->_agent, $matches) && stripos($this->_agent, 'netscape') === false) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_MOZILLA);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Lynx or not (last updated 1.7)
     * @return boolean True if the browser is Lynx otherwise false
     */
    protected function checkBrowserLynx()
    {
        if (stripos($this->_agent, 'lynx') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Lynx'));
            $aversion = explode(' ', (isset($aresult[1]) ? $aresult[1] : ""));
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_LYNX);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Amaya or not (last updated 1.7)
     * @return boolean True if the browser is Amaya otherwise false
     */
    protected function checkBrowserAmaya()
    {
        if (stripos($this->_agent, 'amaya') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Amaya'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
                $this->setBrowser(self::BROWSER_AMAYA);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Safari or not (last updated 1.7)
     * @return boolean True if the browser is Safari otherwise false
     */
    protected function checkBrowserSafari()
    {
        if (stripos($this->_agent, 'Safari') !== false
            && stripos($this->_agent, 'iPhone') === false
            && stripos($this->_agent, 'iPod') === false) {

            $aresult = explode('/', stristr($this->_agent, 'Version'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            } else {
                $this->setVersion(self::VERSION_UNKNOWN);
            }
            $this->setBrowser(self::BROWSER_SAFARI);
            return true;
        }
        return false;
    }

    /**
     * Detect if URL is loaded from FacebookExternalHit
     * @return boolean True if it detects FacebookExternalHit otherwise false
     */
    protected function checkFacebookExternalHit()
    {
        if(stristr($this->_agent,'FacebookExternalHit'))
        {
            $this->setRobot(true);
            $this->setFacebook(true);
            return true;
        }
        return false;
    }

    /**
     * Detect if URL is being loaded from internal Facebook browser
     * @return boolean True if it detects internal Facebook browser otherwise false
     */
    protected function checkForFacebookIos()
    {
        if(stristr($this->_agent,'FBIOS'))
        {
            $this->setFacebook(true);
            return true;
        }
        return false;
    }

    /**
     * Detect Version for the Safari browser on iOS devices
     * @return boolean True if it detects the version correctly otherwise false
     */
    protected function getSafariVersionOnIos() 
    {
        $aresult = explode('/',stristr($this->_agent,'Version'));
        if( isset($aresult[1]) ) 
        {
            $aversion = explode(' ',$aresult[1]);
            $this->setVersion($aversion[0]);
            return true;
        }
        return false;
    }

    /**
     * Detect Version for the Chrome browser on iOS devices
     * @return boolean True if it detects the version correctly otherwise false
     */
    protected function getChromeVersionOnIos() 
    {
        $aresult = explode('/',stristr($this->_agent,'CriOS'));
        if( isset($aresult[1]) ) 
        {
            $aversion = explode(' ',$aresult[1]);
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_CHROME);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iPhone or not (last updated 1.7)
     * @return boolean True if the browser is iPhone otherwise false
     */
    protected function checkBrowseriPhone() {
        if( stripos($this->_agent,'iPhone') !== false ) {
            $this->setVersion(self::VERSION_UNKNOWN);
            $this->setBrowser(self::BROWSER_IPHONE);
            $this->getSafariVersionOnIos();
            $this->getChromeVersionOnIos();
            $this->checkForFacebookIos();
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iPad or not (last updated 1.7)
     * @return boolean True if the browser is iPad otherwise false
     */
    protected function checkBrowseriPad() {
        if( stripos($this->_agent,'iPad') !== false ) {
            $this->setVersion(self::VERSION_UNKNOWN);
            $this->setBrowser(self::BROWSER_IPAD);
            $this->getSafariVersionOnIos();
            $this->getChromeVersionOnIos();
            $this->checkForFacebookIos();
            $this->setTablet(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iPod or not (last updated 1.7)
     * @return boolean True if the browser is iPod otherwise false
     */
    protected function checkBrowseriPod() {
        if( stripos($this->_agent,'iPod') !== false ) {
            $this->setVersion(self::VERSION_UNKNOWN);
            $this->setBrowser(self::BROWSER_IPOD);
            $this->getSafariVersionOnIos();
            $this->getChromeVersionOnIos();
            $this->checkForFacebookIos();
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Android or not (last updated 1.7)
     * @return boolean True if the browser is Android otherwise false
     */
    protected function checkBrowserAndroid()
    {
        if (stripos($this->_agent, 'Android') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'Android'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            } else {
                $this->setVersion(self::VERSION_UNKNOWN);
            }
            if (stripos($this->_agent, 'Mobile') !== false) {
                $this->setMobile(true);
            } else {
                $this->setTablet(true);
            }
            $this->setBrowser(self::BROWSER_ANDROID);
            return true;
        }
        return false;
    }

    /**
     * Determine the user's platform (last updated 1.7)
     */
    protected function checkPlatform()
    {
        if (stripos($this->_agent, 'windows') !== false) 
        {
            $this->_platform = self::PLATFORM_WINDOWS;
        } 
        else if (stripos($this->_agent, 'iPad') !== false) 
        {
            $this->_platform = self::PLATFORM_IPAD;
        } 
        else if (stripos($this->_agent, 'iPod') !== false) 
        {
            $this->_platform = self::PLATFORM_IPOD;
        } 
        else if (stripos($this->_agent, 'iPhone') !== false) 
        {
            $this->_platform = self::PLATFORM_IPHONE;
        } 
        elseif (stripos($this->_agent, 'mac') !== false) 
        {
            $this->_platform = self::PLATFORM_APPLE;
        } 
        elseif (stripos($this->_agent, 'android') !== false) 
        {
            $this->_platform = self::PLATFORM_ANDROID;
        } 
        elseif (stripos($this->_agent, 'linux') !== false) 
        {
            $this->_platform = self::PLATFORM_LINUX;
        } 
        else if (stripos($this->_agent, 'Nokia') !== false) 
        {
            $this->_platform = self::PLATFORM_NOKIA;
        } 
        else if (stripos($this->_agent, 'BlackBerry') !== false) 
        {
            $this->_platform = self::PLATFORM_BLACKBERRY;
        } 
        elseif (stripos($this->_agent, 'FreeBSD') !== false) 
        {
            $this->_platform = self::PLATFORM_FREEBSD;
        } 
        elseif (stripos($this->_agent, 'OpenBSD') !== false) 
        {
            $this->_platform = self::PLATFORM_OPENBSD;
        } 
        elseif (stripos($this->_agent, 'NetBSD') !== false) 
        {
            $this->_platform = self::PLATFORM_NETBSD;
        } 
        elseif (stripos($this->_agent, 'OpenSolaris') !== false) 
        {
            $this->_platform = self::PLATFORM_OPENSOLARIS;
        } 
        elseif (stripos($this->_agent, 'SunOS') !== false) 
        {
            $this->_platform = self::PLATFORM_SUNOS;
        } 
        elseif (stripos($this->_agent, 'OS\/2') !== false) 
        {
            $this->_platform = self::PLATFORM_OS2;
        } 
        elseif (stripos($this->_agent, 'BeOS') !== false) 
        {
            $this->_platform = self::PLATFORM_BEOS;
        } 
        elseif (stripos($this->_agent, 'win') !== false) 
        {
            $this->_platform = self::PLATFORM_WINDOWS;
        }

    }
}
// browser detect class ====================================


$browser = new Browser();
$browserName = $browser->getBrowser();
$browserVersion = 0 + $browser->getVersion();
//if ($browserName == 'Internet Explorer') $browserVersion = 1 + $browserVersion; // ?? valami�rt itt rosszat mutat
$browserWarning = '';
if ((($browserName == 'Firefox') & ($browserVersion < 30)) |
    (($browserName == 'Chrome') & ($browserVersion < 10)) |
    (($browserName == 'Internet Explorer') & ($browserVersion < 9)) |
    (($browserName == 'Opera') & ($browserVersion < 30))) {
		$browserWarning = 'Az �n b�ng�sz� programja elavult, nem t�mogatott.\n\n'.
		                  'K�rj�k friss�tse a b�ng�sz�j�t!\n\n'.
						  'Javasolt b�ng�sz�: Firefox 43, Chrome 47 vagy �jabb verzi�\n\n'.
						  'Jelenlegi b�ng�sz�:'.$browserName.' '.$browserVersion;
} 


class plgSystemLi_de extends JPlugin
{
	
    /**
     * Constructor.
     *
     * @param object $subject The object to observe
     * @param array $config  An array that holds the plugin configuration
     */
    public function __construct(& $subject, $config)
    {
        error_reporting(E_ERROR | E_PARSE);
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }

	/**
	  * az aktu�lis usern�l be�ll�tja a "gr" grupba a dinamikus tags�got ha $value="tru" akkor tag, ha "fasle" akkor nem tag
	  * @param Juser aktu�lis user
	  * @param integer group_id
	  * @param boolean
	  * @return void
	  */
	protected function setGroupMember($user,$gr,$value) {
		$db = JFactory::getDBO();
		if ($value) {
			$db->setQuery('select user_id from #__user_usergroup_map where user_id='.$user->id.' and group_id='.$gr);
			$res = $db->loadObject();
			if ($res == false) {
			  $db->setQuery('insert into #__user_usergroup_map values ('.$user->id.','.$gr.')');
			  $db->query();
			}  
		} else {
			$db->setQuery('delete from #__user_usergroup_map where user_id='.$user->id.' and group_id='.$gr);
			$db->query();
		}
	}
	
	/**
	  * a task legelej�n fut le.
	  * 1. spec SEO URL kezel�s
	  * 2. dinamikus userGroup tags�g be�ll�t�s
	  */
	public function onAfterInitialise() {
		//if (JRequest::getVar('limit')=='')
		JRequest::setVar('limit',20);
		
		// dinamikus usergroup kezel�s
		$user = JFactory::getUser();
		$db = JFactory::getDBO();
		if ($user->id > 0) {
			// [TG] (t�mak�r gazda), [TT] (t�mak�r tag) �s [VG] (vita gazda) usergroupok meghat�roz�sa
			$grTT = 0;
			$grTG = 0;
			$grVG = 0;
			$db->setQuery('select id from #__usergroups where title like "[TG]%"');
			$res = $db->loadObject();
			if ($res) $grTG = $res->id;
			$db->setQuery('select id from #__usergroups where title like "[VG]%"');
			$res = $db->loadObject();
			if ($res) $grVG = $res->id;
			$db->setQuery('select id from #__usergroups where title like "[TT]%"');
			$res = $db->loadObject();
			if ($res) $grTT = $res->id;
			
			//DBG echo 'grTG='.$grTG.' grVG='.$grVG.'<br />';
			if (($grTG > 0) & ($grVG > 0)) {
				
				// aktu�lis t�mak�r �s szavaz�s meg�llap�t�sa
				$temakor = 0;
				$szavazas = 0;
				if (JRequest::getVar('temakor') > 0) $temakor = JRequest::getVar('temakor');
				if (JRequest::getVar('szavazas') > 0) $szavazas = JRequest::getVar('szavazas');
				if (JRequest::getVar('option')=='com_content') {
					// cikk lista vagy cikk megjelenit�s
					if (JRequest::getVar('view')=='category') {
						$db->setQuery('select alias from #__categories where id='.$db->quote(JRequest::getVar('id',0)));
					} else {
						$w = explode(':',JRequest::getVar('id'));
						$db->setQuery('select catid from #__content where id='.$db->quote($w[0]));
						$res = $db->loadObject();
						if ($res) $db->setQuery('select alias from #__categories where id='.$res->catid);
					}
				}
				if (JRequest::getVar('option')=='com_jdownloads') {
					// file let�lt�s listta vagy file oldal 
					if (JRequest::getVar('view')=='category') {
						$db->setQuery('select alias from #__jdownloads_categories where id='.$db->quote(JRequest::getVar('catid')));
					} else {
						$db->setQuery('select cat_id from #__jdownloads_files where id='.$db->quote(JRequest::getVar('fileid')));
						$res = $db->loadObject();
						if ($res) $db->setQuery('select alias from #__jdownloads_categories where id='.$res->cat_id);
					}
				}
				$res = $db->loadObject();
				//DBG echo $db->getQuery().'<br />';
				if ($res) {
				  if (substr($res->alias,0,1) == 't')	$temakor = 0 + substr($res->alias,1,10);
				  if (substr($res->alias,0,2) == 'sz')	$szavazas = 0 + substr($res->alias,2,10);
				}
				if ($temakor == 0) {
					$db->setQuery('select temakor_id from #__szavazasok where id='.$db->quote($szavazas));
					$res = $db->loadObject();
					if ($res) $temakor = $res->temakor_id;
				}
				//DBG echo 'temakor='.$temakor.' szavazas='.$szavazas.'<br />';

				// ha user tag az adott t�mak�rben akkor [TT] usergroupba felvenni ha nem onnan t�r�lni
				if ($grTT > 0) {
				  $db->setQuery('select * from #__tagok where user_id="'.$user->id.'" and temakor_id="'.$db->quote($temakor).'"');
				  $res = $db->loadObject();
				  $this->setGroupMember($user, $grTT, $res);
				}
				
				// ha user tag-admin az aktu�lis t�mak�rben akkor [TG] usergroupba felvessz�k, ha nem onnan t�r�lj�k]
				$db->setQuery('select * from #__tagok where user_id="'.$user->id.'" and temakor_id="'.$db->quote($temakor).'" and admin=1');
				$res = $db->loadObject();
				$this->setGroupMember($user, $grTG, $res);

				// ha user vita ind�t� az aktu�lis vit�ban akkor [VG] usergroupba felvessz�k, ha nem onnan t�r�lj�k]
				$db->setQuery('select * from #__szavazasok where id='.$db->quote($szavazas));
				$res = $db->loadObject();
				if ($res) {
				  $this->setGroupMember($user, $grVG, ($res->letrehozo == $user->id));
				} else {
				  $this->setGroupMember($user, $grVG, $false);
				}
			} // van grTG �s grVG
		} // user be van jelentkezve (dinamikus usergroup kezel�s)
	}
}

// glob�lisan haszn�lhat� saj�t rutinok

/**
  * t�voli szolg�ltat�s h�v�s
  * @param string url
  * @param string 'GET' vagy 'POST'
  * @param array data  param�terek ["n�v" => "�rt�k",....]
  * @param string extra header sor (elhagyhat�)
  * @return string
*/
function remoteCall($url,$method,$data,$extraHeader='') {
	$result = '';
	if ($extraHeader != '') {
		$extraHeader .= "\r\n";
	}	
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n".$extraHeader,
			'method'=> $method,
			'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	return $result;
}


/**
  * get avatar
  * @return string  html img tag
  * @param integer user.id
*/  
function getAvatar($userId,$size=100, $title="") {
	$noImage = JURI::base().'images/stories/noavatar.jpg';
	if ($userId <= 0) {
		$result = $noImage;
	} else {
		$user = JFactory::getUser($userId);
		if ($user->id <= 0) {
			$result = $noImage;
		} else {
			$result = 'http://www.gravatar.com/avatar/'.md5($user->email).'?s='.$size.'&d=blank';
		}
	}
	if ($title != '') 
		$result .= ' title="'.$title.'"';
	return '<img src="'.$result.'" />';
}

/**
  * utf8 substr html entity -ket nem v�g f�lbe
*/  
function utf8Substr($str,$start,$length) {
	$s = trim(strip_tags($str));
    $s = html_entity_decode($s, ENT_COMPAT, 'UTF-8');
	$s = str_replace('&nbsp;',' ',$s);
	$origLength = mb_strlen($s);
    if (($origLength > $length) | ($start != 0)) {
		$s = mb_substr($s,$start,$length);
		$i = mb_strlen($s);
		while (($i > 1) & 
			   (mb_substr($s,$i,1) != ' ') & 
			   (mb_substr($s,$i,1) != ',') & 
			   (mb_substr($s,$i,1) != '-') & 
			   (mb_substr($s,$i,1) != '.')) {
		   $i--;
		}		   
		$s = mb_substr($s,0,$i);	   
	}
	if (mb_strlen($s) < $origLength) $s .= '...';
	return $s;
}

/**
  * seg�d rutinok az ADA h�v�shoz
*/  
function base64url_encode($data) { 
	  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
	  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 


/**
  * K�p kiemel�se le�r�s sz�vegb�l
  * @param string leir�s sz�veg
  * @return string  image url
*/  
function kepLeirasbol($leiras) {
	
	  // echo 'leiras=<pre><code>'.$leiras.'</code></pre>';
	
	  $noImage = JURI::root().'images/stories/noimage.png';
	  // img tag kiemel�se
	  $matches = Array();
	  preg_match('/<img[^>]+>/i', $leiras, $matches);
	  if (count($matches) > 0) {
		  $img = $matches[0];
		  // src attributum kiemel�se
		  preg_match('/src="[^"]+"/i', $img, $matches);
		  if (count($matches) > 0) {
			$src = $matches[0];
		  } else {
			$src = $noImage;  
		  }	
	  } else {
		  $src = $noImage;	
	  }
	  $src = str_replace('src=','',$src);
	  $src = str_replace('robitc/','192.168.0.12/',$src);
	  return str_replace('"','',$src);
}

