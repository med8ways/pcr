<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\pcr\PageTheme
 */

$this->inc('elements/header.php');
?>

      <main class="content">
        <!--if sub_head_title-->
        <!--    include elements/sub-head-->
        <div class="content__cover content__cover-lg">
          <div class="sidebar-title">

            <?php $sidebar_title=new Area('sidebar_title');
            $sidebar_title->display($c);
            ?>
              
            </div>

          <div class="bg-text bg-text_right cover-bg-text" data-animation="parallax">
      
            <?php $bg_txt=new Area('bg_text');
            $bg_txt->display($c);
            ?>
          </div>
          <div class="image-box image-box_cover image-box_cover-lg image-box_top-shadow image-box_btm-shadow" data-animation="parallax">
          <?php $image_cover=new Area('Image Cover');
          $image_cover->display($c);
          ?>
          </div>
          <div class="grid-container">
            <div class="grid-x grid-margin-x">
              <div class="large-offset-1 large-8 cell">
                <div class="info-box info-box_cover" data-animation="stagger">
                  <div class="info-box__subtitle">

                 <?php $sub_title=new Area('sub_title');
                 $sub_title->display($c);
                 ?>
                  </div>
                  <h1>
                   
                <?php 
                $title=new Area('title');
                $title->display($c);
                ?>
                  </h1>
                  <div class="info-box__inner">
                    <p>
                      <?php $info=new Area('info');
                      $info->display($c);
                      ?>
                  </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content__api">
          <!--div(data-embedded-src="https://www.autoscout24.ch/fr/hci/list?design=3071&filter=6353" class="embedded-content-area")-->
          <div class="embedded-content-area" data-embedded-src="https://www.autoscout24.ch/fr/hci/list?design=124&amp;filter=121"></div>
          <script src="https://www.autoscout24.ch/MVC/Content/as24-hci-desktop/js/e.min.js"></script>
          <!--script(src='scripts/lib/autoscout24.js')-->
        </div>
      </main>


      <?php
      $this->inc('elements/footer.php');
?>