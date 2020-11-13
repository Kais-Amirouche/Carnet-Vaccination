


  </div>  <!-- container -->
  <footer>
    <div class="foot">
      <div class="contact">
        <p><a href="contact.php">Besoin d'aide?</a></p>
        <?php if(isLogged()) { ?>
          <br>
        <p><a href="mesquestions.php">Mes questions?</a></p>
        <?php } ?>
      </div>
    </div>
  </footer>
</body>
</html>
