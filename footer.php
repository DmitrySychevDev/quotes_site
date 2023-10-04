<?php
include "config.php";

echo '<footer>
      <section class="footer">
        <div class="footer__copyright">
          <div class="copyright__title">
            <div class="footer__logo">
              <img src="' . $BASE_URL . '/assets/images/logo.png" alt="logo" />
            </div>
            <h3 class="footer__title">Quotient</h3>
          </div>
          <p>© 2023 Все права защищены</p>
        </div>
        <div class="footer__about-us">
          <h3>О нас</h3>
          <p>
            Мы - команда любителей цитат, которые стремятся поделиться
            вдохновляющими мыслями и идеями с миром.
          </p>
        </div>
        <div class="footer__contacts">
          <h3 class="contacts__title">Контакты</h3>
          <div class="contacts__socials">
            <div class="contacts__social">
              <a target="_blank" href="https://vk.com/" title="vk">
                <img src="' . $BASE_URL . './assets/images/vk.png" alt="vk"/>
              </a>
            </div>
            <div class="contacts__social">
              <a target="_blank" href="https://www.facebook.com/" title="facebook">
                <img src="' . $BASE_URL . '/assets/images/facebook.png" alt="facebook">
              </a>
            </div>
            <div class="contacts__social">
              <a target="_blank" href="https://twitter.com/" title="twitter">
                <img src="' . $BASE_URL . './assets/images/twitter.jpg" alt="twitter">
              </a>
            </div>
            <div class="contacts__social">
              <a target="_blank" href="https://web.telegram.org/" title="telegram">
               <img src="' . $BASE_URL . './assets/images/telegramm.jpg" alt="telegram">
              </a>
            </div>
          </div>
        </div>
      </section>
    </footer>';
?>