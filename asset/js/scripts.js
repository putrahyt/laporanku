/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    
})(jQuery);

$(function() {
    $('.addMentor').on('click', function() {
        $('#fullname').val("");
        $('#username').val("");
        $('#jabatan').val("");
        $('#email').val("");
        $('#noHP').val("");
        $('#divisi').val("");
        
    })

    $('.ubahDataMentor').on('click', function() {
        const id = $(this).data('id');
        const url = $(this).data('url');

        $.ajax({
            url: url + '/mentor/getUbahMentor',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#fullname').val(data.full_name);
                $('#username').val(data.username);
                $('#divisi').val(data.divisi);
                $('#email').val(data.email);
                $('#jabatan').val(data.jabatan);
                $('#noHP').val(data.noHP);
                $('#id').val(data.id);
            }
        })
    })

    $('.addLaporanHarian').on('click', function() {
        const url = $(this).data('url');
        $('#formModalLabel').html('Tambah Laporan Harian');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#aktivitas').val("");
        $('#catatan').val("");
        $('.modal-body form').attr('action', url + '/peserta/addLaporanHarian');
    })

    $('.ubahLaporanHarian').on('click', function() {
        const url = $(this).data('url');
        const id = $(this).data('id');
        $('#formModalLabel').html('Ubah Laporan Harian');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', url + '/peserta/ubahAktivitas');

        $.ajax({
            url: url + '/peserta/getUbahAktivitas',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#aktivitas').val(data.aktivitas);
                $('#catatan').val(data.catatan);
                $('#url').val(data.url);
                $('#id').val(data.id);
            }
        })

    })

    $('.addLaporanAkhir').on('click', function() {
        const url = $(this).data('url');
        $('#formModalLabel').html('Kirim Laporan Akhir');
        $('.modal-footer button[type=submit]').html('Kirim');
        $('#aktivitas').val("");
        $('#url').val("");
        $('#dokumen').val("");
        $('.modal-body form').attr('action', url + '/peserta/addLaporanAkhir');
    })

    $('.ubahLaporanAkhir').on('click', function() {
        const url = $(this).data('url');
        const id = $(this).data('id');
        $('#formModalLabel').html('Ubah Laporan AKhir');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', url + '/peserta/ubahLaporanAkhir');

        $.ajax({
            url: url + '/peserta/getUbahLaporanAkhir',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#aktivitas').val(data.aktivitas);
                $('#url').val(data.url);
                $('#id').val(data.id);
            }
        })
    })

    $('.ubahDataPeserta').on('click', function() {
        const id = $(this).data('id');
        const url = $(this).data('url');

        $.ajax({
            url: url + '/peserta/getUbahPeserta',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#fullname').val(data.fullname);
                $('#username').val(data.username);
                $('#divisi').val(data.divisi);
                $('#instansi').val(data.instansi);
                $('#jurusan').val(data.jurusan);
                $('#email').val(data.email);
                $('#npm').val(data.npm);
                $('#noHP').val(data.noHP);
                $('#id').val(data.id);
            }
        })
    })

    $('.tolaklaporanharian').on('click', function() {
        $('#catatan').val("");
        const id = $(this).data('id');

        $('#idlaporanpeserta').val(id);
    })

    $('.tolaklaporanakhir').on('click', function() {
        $('#catatan').val("");
        const id = $(this).data('id');

        $('#idlaporanpeserta').val(id);
    })
    
    $('.deleteMentor').on('click', function(e) {
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
    
    $('.deletePeserta').on('click', function(e) {
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

    $('.deleteAktivitas').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Data aktivitas akan dihapus',
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

    $('.deletelaporan').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Data Laporan Akhir akan dihapus',
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

    $('.acclaporanharian').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Setujui laporan peserta?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Setujui'
        }).then((result) => {
            if(result.value) {
                document.location.href = href;
            }
        });
    })

    $('.accsemualaporanharian').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Setujui semua laporan peserta?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Setujui'
        }).then((result) => {
            if(result.value) {
                document.location.href = href;
            }
        });
    })

    $('.acclaporanakhir').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Setujui laporan akhir peserta?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Setujui'
        }).then((result) => {
            if(result.value) {
                document.location.href = href;
            }
        });
    })

    $('input[name="tanggalaktivitas"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="tanggalaktivitas"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
    });
  
    $('input[name="tanggalaktivitas"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.accPeserta').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title : 'Setujui Peserta?',
            text : '',
            icon : 'warning',
            showCancelButton : true,
            confirmButtonColor : '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Setujui'
        }).then((result) => {
            if(result.value) {
                document.location.href = href;
            }
        })
    })

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
})
