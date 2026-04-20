<!-- Bootstrap 5 JS + jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function () {

  /* ── Date label ── */
  const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const now = new Date();
  $('#dateLabel').text(`${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}, ${now.getFullYear()}`);

  /* ── Sidebar toggle (mobile) ── */
  $('#sidebarToggle').on('click', function () {
    $('#sidebar').toggleClass('open');
    $('#overlay').toggleClass('show');
  });
  $('#overlay').on('click', function () {
    $('#sidebar').removeClass('open');
    $('#overlay').removeClass('show');
  });

  /* ── Nav active ── */
  $('.nav-link-item').on('click', function () {
    $('.nav-link-item').removeClass('active');
    $(this).addClass('active');
  });

  /* ── Sidebar dropdowns ── */
  $('.nav-dropdown-toggle').on('click', function () {
    const key     = $(this).data('dropdown');
    const submenu = $('#dd-' + key);
    const isOpen  = $(this).hasClass('open');

    // close all others
    $('.nav-dropdown-toggle').not(this).removeClass('open');
    $('.nav-submenu').not(submenu).removeClass('open');

    // toggle this one
    $(this).toggleClass('open', !isOpen);
    submenu.toggleClass('open', !isOpen);
  });

  /* ── Sub-item active ── */
  $('.nav-sub-item').on('click', function () {
    $('.nav-sub-item').removeClass('active');
    $(this).addClass('active');
    // keep parent toggle highlighted
    $(this).closest('.nav-dropdown').find('.nav-dropdown-toggle').addClass('open');
  });

  /* ── Notification panel ── */
  $('#notifBtn').on('click', function (e) {
    e.stopPropagation();
    $('#profilePanel').removeClass('show');
    $('#profileBtn').removeClass('active');
    $('#notifPanel').toggleClass('show');
    $(this).toggleClass('active');
  });

  /* ── Profile dropdown ── */
  $('#profileBtn').on('click', function (e) {
    e.stopPropagation();
    $('#notifPanel').removeClass('show');
    $('#notifBtn').removeClass('active');
    $('#profilePanel').toggleClass('show');
    $(this).toggleClass('active');
  });

  /* ── Close panels on outside click ── */
  $(document).on('click', function () {
    $('#notifPanel').removeClass('show');
    $('#profilePanel').removeClass('show');
    $('#notifBtn, #profileBtn').removeClass('active');
  });
  $('#notifPanel, #profilePanel').on('click', function (e) { e.stopPropagation(); });

  /* ── Mark all read ── */
  $('.ph-clear').on('click', function () {
    $('.notif-item').removeClass('unread');
    $('.unread-dot').remove();
    $('.notif-count').fadeOut(200, function () { $(this).remove(); });
  });

  /* ── Fullscreen ── */
  $('#fullscreenBtn').on('click', function () {
    if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen();
      $(this).find('i').removeClass('bi-fullscreen').addClass('bi-fullscreen-exit');
    } else {
      document.exitFullscreen();
      $(this).find('i').removeClass('bi-fullscreen-exit').addClass('bi-fullscreen');
    }
  });

  /* ── Animated counters ── */
  function animateCount(id, target, prefix, suffix, duration) {
    let start = 0, step = target / (duration / 16);
    const timer = setInterval(function () {
      start = Math.min(start + step, target);
      let val = Math.floor(start).toLocaleString();
      $('#' + id).text(prefix + val + suffix);
      if (start >= target) clearInterval(timer);
    }, 16);
  }
  animateCount('statUsers',   48293, '',  '', 800);
  animateCount('statOrders',   9412, '',  '', 800);
  animateCount('statRevenue', 184700,'$', '', 900);
  animateCount('statReviews',   2841, '',  '', 700);

  /* ── Bar chart ── */
  const months2 = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  const values  = [62,78,55,90,84,70,95,88,76,102,85,118];
  const maxVal  = Math.max(...values);
  let barHtml   = '';
  values.forEach(function (v, i) {
    const pct = Math.round((v / maxVal) * 100);
    const isActive = (i === 11) ? ' active' : '';
    barHtml += `
      <div class="bar-wrap">
        <div class="bar${isActive}" style="height:${pct}%; background:${isActive ? 'var(--primary)' : 'var(--accent)'};"
             title="${months2[i]}: $${v}k"></div>
        <div class="bar-label">${months2[i]}</div>
      </div>`;
  });
  $('#barChart').html(barHtml);

  /* ── Orders table ── */
  const colors  = ['#4F46E5','#06B6D4','#10B981','#F59E0B','#EF4444','#8B5CF6'];
  const statuses = [
    ['Completed','pill-success'],
    ['Pending',  'pill-warning'],
    ['Cancelled','pill-danger'],
    ['Processing','pill-info']
  ];
  const orders = [
    ['Ayesha M.','AY','MacBook Pro 16"','$2,499','Apr 18, 2025'],
    ['Bilal R.',  'BR','Sony WH-1000XM5','$349','Apr 17, 2025'],
    ['Nadia K.', 'NK','iPad Air','$749','Apr 16, 2025'],
    ['Hamza S.', 'HS','Samsung S24 Ultra','$1,299','Apr 15, 2025'],
    ['Fatima Z.','FZ','Apple Watch S9','$429','Apr 14, 2025'],
    ['Usman A.', 'UA','Dell XPS 15','$1,899','Apr 13, 2025'],
  ];

  let tableHtml = '';
  orders.forEach(function (o, i) {
    const [label, cls] = statuses[i % statuses.length];
    tableHtml += `
      <tr>
        <td><div class="d-flex align-items-center gap-2">
          <div class="avatar-sm" style="background:${colors[i]}">${o[1]}</div>
          <span>${o[0]}</span>
        </div></td>
        <td>${o[2]}</td>
        <td><strong>${o[3]}</strong></td>
        <td style="color:var(--muted)">${o[4]}</td>
        <td><span class="status-pill ${cls}">${label}</span></td>
      </tr>`;
  });
  $('#ordersTable tbody').html(tableHtml);

  /* ── Activity feed ── */
  const acts = [
    ['bi-person-plus-fill','icon-purple','New user <strong>Sara Ahmed</strong> registered','2 min ago'],
    ['bi-bag-check-fill',  'icon-cyan',  'Order <strong>#ORD-4821</strong> placed','14 min ago'],
    ['bi-exclamation-triangle-fill','icon-amber','Server load reached <strong>87%</strong>','1 hr ago'],
    ['bi-star-fill',       'icon-green', '<strong>5-star</strong> review received','3 hr ago'],
    ['bi-x-circle-fill',   'icon-amber', 'Order <strong>#ORD-4799</strong> cancelled','5 hr ago'],
  ];
  let actHtml = '';
  acts.forEach(function (a) {
    actHtml += `
      <div class="activity-item">
        <div class="act-icon ${a[1]}"><i class="bi ${a[0]}"></i></div>
        <div>
          <div class="act-text">${a[2]}</div>
          <div class="act-time">${a[3]}</div>
        </div>
      </div>`;
  });
  $('#activityFeed').html(actHtml);

  /* ── Search filter (orders table) ── */
  $('#searchInput').on('input', function () {
    const q = $(this).val().toLowerCase();
    $('#ordersTable tbody tr').each(function () {
      $(this).toggle($(this).text().toLowerCase().includes(q));
    });
  });

});
</script>
</body>
</html>