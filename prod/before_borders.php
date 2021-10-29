<?php
  class SiteConfig {
    /**
     * Proxied Data
     * =============
     * Some data is only available AFTER the before borders
     * are done. So I'm passing these values as references
     * from the point that they are actually available (borders)
     */
    private $thePage;
    private $cmsPageData;
    private $siteTokens;
    private $proxy = "https://gh-proxy.jsiwicki.workers.dev/?url=";

    /**
     * Collections
     * ===========
     */
    private $noSilo = array(
      "opinion",
      "sitemap",
      "service-area",
      "privacy-policy",
      "free-estimate",
      "repairing-seawalls-and-bulkheads",
      "stem-wall-repair",
      "crack-stitching"
    );
    private $modulePages = array(
      "opinion",
      "before-after",
      "photo-gallery",
      "refer",
      "meet-the-team",
      "news-and-events",
      "blog",
      "reviews",
      "awards",
      "press-release",
      "crew-review",
      "case-studies",
      "affiliations",
      "technical-papers",
      "case-studies",
      "search",
      "service-area",
      "homeshows",
      "about-us",
      "testimonials",
      "free-estimate"
    );
    private $contentHeaderImages = array(
      "basement-waterproofing" => "http://devtest24.basementsite.com//core/images/templates/health/headers/waterproofing-silo-test.jpg",
      "commercial-foundation-contractor" => "http://devtest24.basementsite.com//core/images/templates/health/headers/commercial-silo-test.jpg",
      "foundation-repair" => "http://devtest24.basementsite.com//core/images/templates/health/headers/foundation-silo-test.jpg",
      "crawl-space-repair" => "http://devtest24.basementsite.com//core/images/templates/health/headers/crawl-silo-test.jpg",
      "default" => "http://devtest24.basementsite.com//core/images/templates/health/headers/wall-crack-silo-test.jpg",
    );
    private $devLinks = array(
      // Css files
      "global.css" => "https://raw.githubusercontent.com/bs-production/burger-template-demo/master/prod/global.css",
      "home.css" => "https://raw.githubusercontent.com/bs-production/burger-template-demo/master/prod/home.css",
      "content.css" => "https://raw.githubusercontent.com/bs-production/burger-template-demo/master/prod/content.css",

      // JS Files
      "dev_tools.js" => "https://raw.githubusercontent.com/bs-production/burger-template-demo/master/prod/dev_tools.js",
      "home.js" => "https://raw.githubusercontent.com/bs-production/burger-template-demo/master/prod/home.js",
      "content.js" => "https://raw.githubusercontent.com/bs-production/burger-template-demo/master/prod/content.js"
    );
    private $prodLinks = array(
      "favicon.ico" => "https://dc69b531ebf7a086ce97-290115cc0d6de62a29c33db202ae565c.ssl.cf1.rackcdn.com/300/favicon.ico",

      // Fonts
      "fonts.preconnect" => "https://fonts.gstatic.com",
      "fonts.css" => "https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;800;900&display=swap",

      // scripts
      "embla-carousel.js" => "https://unpkg.com/embla-carousel/embla-carousel.umd.js",
      "jquery.js" => "https://cdn.treehouseinternetgroup.com/cms_core/assets/js/jquery.min.js",
      "jquery.colorbox.js" => "https://cdn.treehouseinternetgroup.com/cms_core/assets/js/jquery.colorbox-min.js",
      "slick.js" => "https://cdn.treehouseinternetgroup.com/cms_core/assets/js/slick.min.js",
      "scrollable.js" => "http://devtest24.basementsite.com//core/js/jquery.thScrollable.js"
    );

    /**
     * Helper properties
     * =================
     */
    public $pageType;
    public $isCityPage;
    public $isDev;
    public $isTest;


    /**
     * Switches
     * ==========
     * These are used to render content based on page conditions such as:
     *    - Page Type
     *    - Collection of pages
     *    - Specific pages
     */
    public $showSilo = true;
    public $showBreadcrumbs = true;
    public $showServiceAreas = true;
    public $showContentHeader = true;

    function __construct($thePage, &$cmsPageData, &$siteTokens) {
      $this->thePage = $thePage;
      $this->cmsPageData = &$cmsPageData;
      $this->siteTokens = &$siteTokens;
      $this->isCityPage = (strpos($thePage, 'service-area') !== false) && (strpos($thePage, '/') !== false);
      $this->isDev = (!empty($_GET['dev_template']) && $_GET['dev_template'] == 1) || (!empty($_GET['dev_content']) && $_GET['dev_content'] == 1);
      $this->isTest = (!empty($_GET['test']) && $_GET['test'] == 1);

      $this->handleSetters();
      $this->handleSwitches();
      $this->handleCustomTokenCreation();
    }


    /**
     * SETTERS
     * ========================
     */
    private function handleSetters() {
      $this->set_pageType();
    }

    private function set_pageType() {
      if($this->thePage == "index") {
        $this->pageType = 'HOME';
      } else if($this->substr_in_array($this->modulePages, $this->thePage)) {
        $this->pageType = 'CONTENT';
      } else {
        // This should be UKNOWN
        $this->pageType = 'CONTENT';
      }
    }


    /**
     * SWITCH HANDLERS
     * ========================
     */
    private function handleSwitches() {
      $this->set_showSilo_switch();
      $this->set_showBreadcrumbs_switch();
      $this->set_showServiceAreas_switch();
      $this->set_showContentHeader_switch();
    }

    private function set_showSilo_switch() {
      if($this->substr_in_array($this->noSilo, $this->thePage) || $this->isCityPage) {
        $this->showSilo = false;
      }
    }

    private function set_showBreadcrumbs_switch() {
      if(strpos($this->thePage, 'free-estimate') !== false) {
        $this->showBreadcrumbs = false;
      }
    }

    private function set_showServiceAreas_switch() {
      if((strpos($this->thePage, 'service-area') !== false)) {
        // Don't show service area section in service area pages
        $this->showServiceAreas = false;
      }
    }

    private function set_showContentHeader_switch() {
      if(strpos($this->thePage, 'free-estimate') !== false) {
        // Don't show content header in the free estimate page
        $this->showContentHeader = false;
      }
    }


    /**
     * CUSTOM TOKEN CREATION
     * =======================
     */
    private function handleCustomTokenCreation() {
      // Tags injection
      $this->create_TopInject_token();
      $this->create_BottomInject_token();
      
      // Links Generation
      $this->create_TopNavLinks_token();
      $this->create_BottomNavLinks_token();

      // Content header
      $this->create_ContentHeaderImage_token();
    }

    private function create_TopInject_token() {
      $topData = "";

      // Insert favicon
      $topData .= $this->generateLinkTag($this->prodLinks['favicon.ico'], "icon");
      // Insert CSS reset
      $topData .= $this->generateLinkTag($this->proxy . $this->devLinks['global.css']);

      // Insert fonts
      $topData .= $this->generateLinkTag($this->prodLinks['fonts.preconnect'], "preconnect");
      $topData .= $this->generateLinkTag($this->prodLinks['fonts.css'], "stylesheet");

      // Page type based injection
      switch($this->pageType) { 
        case "HOME": {
          $topData .= $this->generateLinkTag($this->proxy . $this->devLinks['home.css']);
          $topData .= $this->generateScriptTag($this->prodLinks['embla-carousel.js']);
          $topData .= $this->generateScriptTag($this->prodLinks['jquery.js']);
          break;
        }

        /**
         * When the page is unknown, its best
         * to treat it as a CONTENT type
         */
        case "CONTENT":
        default: {
          $topData .= $this->generateLinkTag($this->proxy . $this->devLinks['content.css']);
          $topData .= $this->generateScriptTag($this->prodLinks['jquery.js']);
          $topData .= $this->generateScriptTag($this->prodLinks['slick.js']);
          $topData .= $this->generateScriptTag($this->prodLinks['scrollable.js']);
          $topData .= $this->generateScriptTag($this->prodLinks['jquery.colorbox.js']);
        }
      }

      $this->siteTokens['[[top-inject]]'] = $topData;
    }

    private function create_BottomInject_token() {
      $bottomData = "";

      // Page type based injection
      switch($this->pageType) { 
        case "HOME": {
          $bottomData .= $this->generateScriptTag($this->proxy . $this->devLinks['home.js']);
          break;
        }

        /**
         * When the page is unknown, its best
         * to treat it as a CONTENT type
         */
        case "CONTENT":
        default: {
          $bottomData .= $this->generateScriptTag($this->proxy . $this->devLinks['content.js']);
        }
      }

      $this->siteTokens['[[bottom-inject]]'] = $bottomData;
    }

    private function create_TopNavLinks_token() {
      $topNav = new nav();
      $topNav->superTemplateId = 20;
      $topNav->superMode = 'top';
      $topNav->superItems = array(
        'Services' => array(
            'class' => 'columned',
            'target' => 'services'
        ),
        'Our Work' => array(
            'target' => 'work',
        ),
        48417 => array(
                'target' => 'about',
                'show_about_link' => false
            ),
        'Service Area' => array(
            'target' => 'map',
        ),
        'Free Estimate*' => array(
            'class' => 'free-estimate',
            'target' => 'contact'
        ));

      $this->siteTokens['[[top-nav-links]]'] = $topNav->generateSuperMarkup();
    }

    private function create_BottomNavLinks_token() {
      $bottomNav = new nav();
      $bottomNav->superMode = 'bottom';

      $this->siteTokens['[[bottom-nav-links]]'] = $bottomNav->generateSuperMarkup();
    }

    private function create_ContentHeaderImage_token() {
      $content = "";

      // Only when content header is needed
      if($this->showContentHeader) {
        switch(true) {
          case stristr($this->thePage,"basement-waterproofing"): {
            $content = $this->generateImageTag($this->contentHeaderImages['basement-waterproofing'], "img object-cover-");
            break;
          }
          case stristr($this->thePage,"commercial-foundation-contractor"): {
            $content = $this->generateImageTag($this->contentHeaderImages['commercial-foundation-contractor'], "img object-cover-");
            break;
          }
          case stristr($this->thePage,"foundation-repair"): {
            $content = $this->generateImageTag($this->contentHeaderImages['foundation-repair'], "img object-cover-");
            break;
          }
          case stristr($this->thePage,"crawl-space-repair"): {
            $content = $this->generateImageTag($this->contentHeaderImages['crawl-space-repair'], "img object-cover-");
            break;
          }
          default: {
            $content = $this->generateImageTag($this->contentHeaderImages['default'], "img object-cover-");
          }
        }
      }

      $this->siteTokens['[[content-header-img]]'] = $content;
    }


     /**
     * UTILITIES
     * =======================
     */
    
    /**
     * Returns true when there is a substr match inside an array
     */
    function substr_in_array($haystack, $needle) {
      for($i = 0; $i < count($haystack); $i++) {
        $string_pos = strpos($needle, $haystack[$i]);
  
        if ($string_pos !== false) {
          return true;
        }
      }
  
      return false;
    }

    function generateScriptTag($src) {
      return str_replace(array("\\r", "\\n"), '',sprintf("
        <script type=\"text/javascript\" src=\"%s\"></script>
      ", $src));
    }

    function generateLinkTag($href, $rel = "stylesheet") {
      return str_replace(array("\\r", "\\n"), '',sprintf("
        <link href=\"%s\" rel=\"%s\" ></link>
      ", $href, $rel));
    }

    function generateImageTag($src, $classList = "") {
      return str_replace(array("\\r", "\\n"), '',sprintf("
        <img src=\"%s\" class=\"%s\" />
      ", $src, $classList));
    }

    function getFileFromCDN($fileName) {
      $baseUrl = 'https://cdn.treehouseinternetgroup.com/cms_images/300/';

      echo file_get_contents($baseUrl . $fileName);
    }
  };
?>