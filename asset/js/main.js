(function() {
    "use strict";
  
    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
      el = el.trim()
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    }
  
    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
      if (all) {
        select(el, all).forEach(e => e.addEventListener(type, listener))
      } else {
        select(el, all).addEventListener(type, listener)
      }
    }
  
    /**
     * Easy on scroll event listener 
     */
    const onscroll = (el, listener) => {
      el.addEventListener('scroll', listener)
    }
  
    /**
     * Sidebar toggle
     */
    if (select('.toggle-sidebar-btn')) {
      on('click', '.toggle-sidebar-btn', function(e) {
        select('body').classList.toggle('toggle-sidebar')
      })
    }
  
    /**
     * Search bar toggle
     */
    if (select('.search-bar-toggle')) {
      on('click', '.search-bar-toggle', function(e) {
        select('.search-bar').classList.toggle('search-bar-show')
      })
    }
  
    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
      let position = window.scrollY + 200
      navbarlinks.forEach(navbarlink => {
        if (!navbarlink.hash) return
        let section = select(navbarlink.hash)
        if (!section) return
        if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
          navbarlink.classList.add('active')
        } else {
          navbarlink.classList.remove('active')
        }
      })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)
  
    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header')
    if (selectHeader) {
      const headerScrolled = () => {
        if (window.scrollY > 100) {
          selectHeader.classList.add('header-scrolled')
        } else {
          selectHeader.classList.remove('header-scrolled')
        }
      }
      window.addEventListener('load', headerScrolled)
      onscroll(document, headerScrolled)
    }
  
    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
      const toggleBacktotop = () => {
        if (window.scrollY > 100) {
          backtotop.classList.add('active')
        } else {
          backtotop.classList.remove('active')
        }
      }
      window.addEventListener('load', toggleBacktotop)
      onscroll(document, toggleBacktotop)
    }
  
    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  
    /**
     * Initiate quill editors
     */
    if (select('.quill-editor-default')) {
      new Quill('.quill-editor-default', {
        theme: 'snow'
      });
    }
  
    if (select('.quill-editor-bubble')) {
      new Quill('.quill-editor-bubble', {
        theme: 'bubble'
      });
    }
  
    if (select('.quill-editor-full')) {
      new Quill(".quill-editor-full", {
        modules: {
          toolbar: [
            [{
              font: []
            }, {
              size: []
            }],
            ["bold", "italic", "underline", "strike"],
            [{
                color: []
              },
              {
                background: []
              }
            ],
            [{
                script: "super"
              },
              {
                script: "sub"
              }
            ],
            [{
                list: "ordered"
              },
              {
                list: "bullet"
              },
              {
                indent: "-1"
              },
              {
                indent: "+1"
              }
            ],
            ["direction", {
              align: []
            }],
            ["link", "image", "video"],
            ["clean"]
          ]
        },
        theme: "snow"
      });
    }
  
    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll('.needs-validation')
  
    Array.prototype.slice.call(needsValidation)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  
    /**
     * Initiate Datatables
     */
    const datatables = select('.datatable', true)
    datatables.forEach(datatable => {
      new simpleDatatables.DataTable(datatable, {
        perPageSelect: [5, 10, 15, ["All", -1]],
        columns: [{
            select: 2,
            sortSequence: ["desc", "asc"]
          },
          {
            select: 3,
            sortSequence: ["desc"]
          },
          {
            select: 4,
            cellClass: "green",
            headerClass: "red"
          }
        ]
      });
    })
  
    /**
     * Autoresize echart charts
     */
    const mainContainer = select('#main');
    if (mainContainer) {
      setTimeout(() => {
        new ResizeObserver(function() {
          select('.echart', true).forEach(getEchart => {
            echarts.getInstanceByDom(getEchart).resize();
          })
        }).observe(mainContainer);
      }, 200);
    }

    // sweetalert
    const pesanData = $('.flash-data').data('pesandata');
    const tipeData = $('.flash-data').data('tipedata');

    if (pesanData) {
      if (tipeData) {
          Swal.fire({
              title : pesanData,
              text : '',
              icon : tipeData
          });
      }
    }

    $('.hapusMentor').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');

      Swal.fire({
          title: 'Apakah anda yakin',
          text: "Data mentor akan dihapus",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus data!'
      }).then((result) => {
          if(result.value) {
              document.location.href = href;
          }
      });
    })

    $('.hapusPeserta').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');

      Swal.fire({
          title: 'Apakah anda yakin',
          text: "Data peserta akan dihapus",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus data!'
      }).then((result) => {
          if(result.value) {
              document.location.href = href;
          }
      });
    })

    $('.hapusAktivitas').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');

      Swal.fire({
          title: 'Apakah anda yakin',
          text: "Aktivitas akan dihapus",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus data!'
      }).then((result) => {
          if(result.value) {
              document.location.href = href;
          }
      });
    })
    
    $('.tombolPenilaian').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');

      Swal.fire({
          title: 'Apakah anda yakin',
          text: "Penilaian akhir peserta magang hanya bisa dilakukan sekali saja",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Beri nilai!'
      }).then((result) => {
          if(result.value) {
              document.location.href = href;
          }
      });
    })


    // Tanggapan Pesan
    $('.btnTanggapan').on('click', function() {
      var id = $(this).data('id');
      $('#id_bimbingan').val(id);
    })

    // tolak aktivitas
    $('.tolakaktivitas').on('click', function() {
      var id = $(this).data('id');
      $('#id_aktivitas_tolak').val(id);
    })

    // tolak aktivitas
    $('.accaktivitas').on('click', function() {
      var id = $(this).data('id');
      $('#id_aktivitas_acc').val(id);
    })

    // Daterangepicker
    $('#tanggalaktivitas').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      timePickerSeconds: true,
      startDate: moment(),
      endDate: moment(),
      locale: {
        format: 'DD/MM/YYYY HH:mm:ss'
      }
    });

    $('#periode').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      timePickerSeconds: true,
      startDate: moment(),
      endDate: moment(),
      locale: {
        format: 'DD/MM/YYYY HH:mm:ss'
      }
    });

    $('#tanggalabsensi').daterangepicker({
      startDate: moment(),
      endDate: moment(),
      locale: {
        format: 'DD/MM/YYYY'
      }
    });

    // Fitur Kamera
    const latTarget = $('#koordinat').data('lat');
    const lonTarget = $('#koordinat').data('long');
    const radiusMeter = $('#koordinat').data('jarak');
    const isMobile = /Android|iPhone|iPad|iPod|IEMobile|Opera Mini/i.test(navigator.userAgent);

    const $video = $('#video');
    const $canvas = $('#canvas');

    function hitungJarak(lat1, lon1, lat2, lon2) {
      const R = 6371000;
      const toRad = deg => deg * Math.PI / 180;
      const dLat = toRad(lat2 - lat1);
      const dLon = toRad(lon2 - lon1);
      const a = Math.sin(dLat/2) ** 2 + Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * Math.sin(dLon/2) ** 2;
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      return R * c;
    }

    $('#btnKamera').click(function () {
      if (!isMobile) {
        alert("Fitur absensi sebaiknya digunakan di perangkat mobile untuk akurasi lokasi yang lebih baik.");
        // $('#btnKamera').prop('disabled', true);
        // $('#btnAbsen').prop('disabled', true);
        // die;
      }

      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
          .then(function (stream) {
            $video[0].srcObject = stream;
            $video.show();

            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (pos) {
                const userLat = pos.coords.latitude;
                const userLon = pos.coords.longitude;

                $('#latInput').val(userLat);
                $('#lonInput').val(userLon);

                const jarak = hitungJarak(userLat, userLon, latTarget, lonTarget);

                if (jarak <= radiusMeter) {
                  alert("Lokasi valid, silahkan absen.");
                  $('#btnAbsen').prop('disabled', false);
                } else {
                  alert("Anda berada di luar lokasi absensi. (Jarak: " + Math.round(jarak) + " meter)");
                  $('#btnAbsen').prop('disabled', true);
                }
              }, function () {
                alert("Gagal mendapatkan lokasi.");
              });
            } else {
              alert("Browser tidak mendukung geolocation.");
            }
          })
          .catch(function () {
            alert("Tidak dapat mengakses kamera. Silahkan izinkan terlebih dahulu");
          });
      } else {
        alert("Browser Anda tidak mendukung kamera.");
      }
    });

    $('#absensiForm').submit(function (e) {
      const ctx = $canvas[0].getContext('2d');
      $canvas[0].width = $video[0].videoWidth;
      $canvas[0].height = $video[0].videoHeight;
      ctx.drawImage($video[0], 0, 0, $canvas[0].width, $canvas[0].height);

      const fotoBase64 = $canvas[0].toDataURL('image/jpeg', 0.6);
      $('#fotoInput').val(fotoBase64);
    });

    $('#namapeserta').select2({
      placeholder: "-- Pilih Nama Peserta --",
      allowClear: true
    });
  
})();