  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script>
    const toggleBtn = document.getElementById('sidebarToggle');
    toggleBtn.addEventListener('click', () => {
      if (window.innerWidth < 992) {
        document.body.classList.toggle('sidebar-mobile-open');
      } else {
        document.body.classList.toggle('collapsed');
      }
    });
  </script>
</body>

</html>
