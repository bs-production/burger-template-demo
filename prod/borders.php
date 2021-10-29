<?php
  global $thePage, $cmsPageData, $siteTokens;
  $siteConfig = new SiteConfig($thePage, $csmPageData, $siteTokens);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>[[title]]</title>

    <meta name="description" content="[[description]]">
    <meta name="keywords" content="[[keywords]]">
    [[top-inject]]
  </head>

  <body class='preload'>
    <nav>
      <!-- Top navigation -->
      <section class="navigation-layout">
        <!-- BG for banner -->
        <div class="banner-bg"></div>
        <div class="banner">
          <span class="serving"> Yes, We Serve [territory] </span>
          <a class="number" href="tel:[[phone]]">[[phone]]</a>
        </div>

        <!-- Super nav -->
        [[top-nav-links]]

        <div class="logo-container">
          <a href='/'>
            <video
              class="video"
              loop
              preload="none"
              poster="https://cdn.treehouseinternetgroup.com/cms_images/300/video_thumb.jpg"
            >
              <source
                src="https://dc69b531ebf7a086ce97-290115cc0d6de62a29c33db202ae565c.ssl.cf1.rackcdn.com/300/SaberLogo-NoBorder.mp4"
                type="video/mp4"
              />
              Your browser does not support the video tag.
            </video>
            <img
              class="object-contain- object-left- img"
              src="https://cdn.treehouseinternetgroup.com/cms_images/755/logo.png"
            />
          </a>
        </div>
      </section>
    </nav>

    <main>
      <? if($siteConfig->pageType === "CONTENT"): ?>
        <? if($siteConfig->showContentHeader): ?>
        <section class="content-template-header space-section">
          <div class="bg-container">
            <div class="bg-img">
              [[content-header-img]]
            </div>
            <div class="bg-overlay"></div>
          </div>

          <div class="template-header-title">
            <h1><?= $cmsPageData['page.name']; ?></h1>
          </div>
        </section>
        <? endif; ?>

      <section
        class="content-template-article space-section <?= $siteConfig->showSilo ? "" : 'no-silo'; ?> <?= $siteConfig->showBreadcrumbs ? "" : 'no-breadcrumbs'; ?>"
      >
        <? if($siteConfig->showBreadcrumbs): ?>
        <nav aria-label="Breadcrumb" class="content-template-breadcrumbs">
          [[breadcrumbs]]
        </nav>
        <? endif; ?>

        <? if($siteConfig->showSilo): ?>
        <aside class="content-template-silo">
          <div class="content-template-silo-menu">
            <button id="silo-menu-button">
              Open Menu
              <span class="dropdown">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z"
                    fill="currentColor"
                  />
                </svg>
              </span>
            </button>
          </div>
          <div class="content-template-silo-container" id="silo-container">
            [[single_silo_nav]]
          </div>
        </aside>
        <? endif; ?>

        <article class="content-template-main">
          <? endif; ?>
          [[content]]
          <? if($siteConfig->pageType === "CONTENT"): ?>
        </article>
      </section>
      <? endif; ?>
      
      <? if ($siteConfig->showServiceAreas): ?>
      <!-- Service Areas Section -->
      <section class="service-areas space-section">
        <div class="bg-background"></div>

        <div class="service-area-wrapper">
          <div class="service-area-list">
            <div class="service-area-list-content">
              <h2 class="service-area-title">our service area</h2>
              [[city_scroll:50]]
            </div>
          </div>

          <div class="service-area-map">
            <a href="http://devtest24.basementsite.com//service-area.html"
              ><img
                loading="lazy"
                decoding="async"
                src="https://cdn.treehouseinternetgroup.com/cms_images/300/saber-two-tone-map-2019.png"
                style="width: 70%"
                width="800"
                height="825"
                alt="Saber Foundation Repair Service Area"
            /></a>
          </div>
        </div>
      </section>
      <? endif; ?>
      
      <? if($siteConfig->pageType === "HOME"): ?>
      <!-- Cred Section -->
      <section class="cred-section space-section">
        <div class="cred-controls-container">
          <button class="control prev-control"></button>
          <button class="control next-control"></button>
        </div>

        <div class="carousel cred-wrapper">
          <div class="cred-container">
            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/58e2c31ae2dc7_carlsbad-chamber-of-commerce-logo-1.png" alt="Carlsbad Chamber of Commerce">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/5ca281c55f31f_sfs-chamber-large.jpg" alt="Santa Fe Springs Chamber of Commerce">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/5c6ee99c46617_ebb-logo-002.png" alt="Earthquake Brace + Bolt">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/5c6eea0769d98_sdar-square-002.jpg" alt="San Diego Association of Realtors">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/5c6eeb11e3383_ocar-logo-002.jpg" alt="Orange County Realtors Association of Professionals">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/5c6ef39a215a1_bbb-logo-002.png" alt="Better Business Bureau">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/59108df723790_tbs-logo.png" alt="Basement Systems Certified Dealer Network Member">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/59108c8ec5ae4_supportworks-logo.jpg" alt="Supportworks Dealer Member">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/59108d70c9d24_cleanspace-badge.png" alt="Certified CleanSpace Dealer">
            </div>

            <div class="cred-slide">
              <img class="cred-img" src="https://cdn.treehouseinternetgroup.com/uploads/affiliations/logo/1404.jpg" alt="Dun &amp; Bradstreet Credibility Corp.">
            </div>
          </div>
        </div>
      </section>
      <? endif; ?>
    </main>

    <footer class="footer">
      <div class="row">
        <div class="large-7 large-push-5 columns">
          <div id="footer-links">
            [[bottom-nav-links]]
          </div>
        </div>
        
        <div class="large-5 large-pull-7 columns">
          <div id="footer-contact">
            <a href="/free-estimate.html" id="footer-btn" class="button">contact us</a>
            <p class="footer-phone">Or call us at
              <span><a href="tel:[[phone]]" class="phone_link">[phone]</a></span>
            </p>
            <p class="footer-address"> [[display_addresses]] </p>
            <p>[license number]</p>  
          </div>
        </div>
      </div>
    </footer>

    [[bottom-inject]]
  </body>
</html>