<?php defined('C5_EXECUTE') or die ('Access denied') ;

/**
*@var \concrete\core\page\page $c 
*/
 

?>
<footer class="footer">
        <div class="grid-container">
          <div class="grid-x grid-margin-x">
            <div class="large-offset-1 large-10 cell">
              <div class="footer__top"><a class="logo" href="index.html"><img src="<?php echo $view->getThemePath(); ?>/assets/images/Logo__3WzsE.png" srcset="<?php echo $view->getThemePath(); ?>/assets/images/Logo__3WzsE.png 1x, <?php echo $view->getThemePath(); ?>/assets/images/Logo@2x__t0qaS.png 2x" draggable="false" alt="logo"></a>
                <div class="social-list"><a href="#">facebook</a><a href="#">twitter</a><a href="#">autoscout24</a>
                </div>
              </div>
              <div class="footer__main">
                <div class="grid-x grid-margin-x">
                  <div class="large-3 small-12 cell">
                    <ul>
                      <li><a href=""><?php $footer=new GlobalArea('Footer 1');$footer->display($c); ?></a>
                      </li>
                      
                    </ul>
                  </div>
                  <div class="large-3 small-12 cell">
                    <ul>
                      <li><a href=""><?php $footer=new GlobalArea('Footer 2');$footer->display($c); ?></a>
                      </li>
                      
                    </ul>
                  </div>
                  <div class="large-3 small-12 cell">
                    <ul>
                      <li><a href=""><?php $footer=new GlobalArea('Footer 3');$footer->display($c); ?></a>
                      </li>
                      
                    </ul>
                  </div>
                  <div class="large-3 small-12 cell">
                    <div class="footer__main-contact">
                      <ul>
                        <li> <?php $adr=new GlobalArea('adr');$adr->display($c);?> </li>
                      </ul>
                      <ul>
                        <li>
                          <?php $email_tel_area=new GlobalArea('Email_tel');
                        $email_tel_area->display($c); ?> 
                        </li>
                        
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="footer__copyright">
                <p>&copy; 2018 Prestige Car Romand. <span>All rights reserved.</span> <a href="https://www.8ways.ch/en" title="8 Ways Media Web Design Agency Geneva Google Certified" target="_blank">Designed by 8 Ways Media</a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>


<?php   Loader::element('footer_required');   ?>