


  </div>  <!-- container -->
  <footer>
    <div class="foot">
      <div class="contact">
        <p>Besoin d'aide ? Posez-vos <a href="contact.php">questions</a></p>
        <?php if(isLogged()) { ?>
        <p><a href="mesquestions.php">Mes questions</a></p>
        <?php } ?>
      </div>
    </div>
  </footer>
</body>
</html>
