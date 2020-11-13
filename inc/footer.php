


  </div>  <!-- container -->
    <footer>
      <div class="foot-bg">
        <div class="foot">
          <nav>
            <ul>
              <div class="contact">
                <li><a href="contact.php">Besoin d'aide?</a></li>
                <?php if(isLogged()) { ?>
                <br>
                <li><a href="mesquestions.php">Mes questions?</a></li>
                <?php } ?>
              </div>
            </ul>
          </nav>
        </div>
      </div>
    </footer>
  </body>
</html>
