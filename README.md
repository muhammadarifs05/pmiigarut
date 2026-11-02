# Web Official PC PMII Kabupaten Garut [CI4]

## Deskripsi Ringkas
Salam Pergerakan! Selamat datang di repositori resmi website **Pengurus Cabang Pergerakan Mahasiswa Islam Indonesia (PC PMII) Kabupaten Garut**.

Website ini merupakan **website resmi pertama PC PMII Kabupaten Garut** yang dihadirkan sebagai wujud nyata **akselerasi digitalisasi organisasi** dalam melakukan adaptasi di era digital saat ini. Kehadiran platform ini bertujuan untuk memperkuat transparansi informasi, publikasi karya kader, serta mengintegrasikan pengelolaan administrasi dan media komunikasi PMII se-Kabupaten Garut.

Website ini dikembangkan menggunakan framework **CodeIgniter 4** yang dilengkapi dengan fasilitas halaman *front-end* untuk pengunjung umum dan halaman *back-end* (dashboard) untuk pengelolaan konten oleh administrator maupun author.

<hr>

## Daftar Isi

- [Web Official PC PMII Kabupaten Garut \[CI4\]](#web-official-pc-pmii-kabupaten-garut-ci4)
  - [Deskripsi Ringkas](#deskripsi-ringkas)
  - [Daftar Isi](#daftar-isi)
  - [Teknologi](#teknologi)
  - [Fitur](#fitur)
  - [Instalasi](#instalasi)
    - [Spesifikasi](#spesifikasi)
  - [Lisensi](#lisensi)
  - [Acknowledgment](#acknowledgment)

<hr>

## Teknologi

Teknologi yang digunakan untuk membangun aplikasi ini diantaranya:

1. [CodeIgniter 4](https://codeigniter.com/)
2. [Bootstrap 5.1.1 => Halaman depan](https://getbootstrap.com/)
3. [Bootstrap 3.3.5 => Halaman dashboard](https://getbootstrap.com/)
4. [Bootstrap icon](https://icons.getbootstrap.com/)
5. [FontAwesome 4.3.0](https://fontawesome.com/)
6. [jQuery 2.1.4](https://jquery.com/)
7. [jQueryUI 1.11.4](http://jqueryui.com)
8. [jQuery blockUI 2.70.0](http://malsup.com/jquery/block/)
9. [jQuery-slimScroll 1.3.0](http://rocha.la/jQuery-slimScroll)
10. [jQuery Mockjax 2.0.1](https://github.com/jakerella/jquery-mockjax)
11. [Datatables 1.10.7](https://datatables.net/)
12. [MariaDB / MySQL](https://mariadb.org/)
13. [Summernote](https://summernote.org/)
14. [AOS](http://michalsnik.github.io/aos/)
15. [Boxicons](https://boxicons.com/)
16. [Glightbox](https://biati-digital.github.io/glightbox/)
17. [Swiper 7.0.6](https://swiperjs.com)
18. [Isotope PACKAGED v3.0.6](https://isotope.metafizzy.co)
19. [PHP Email Form Validation - v3.1](https://bootstrapmade.com/php-email-form/)
20. [purecounter.js 1.1.4](https://github.com/srexi/purecounterjs)
21. [Waypoints 4.0.1](https://github.com/imakewebthings/waypoints)
22. [Pace 1.0.2](https://github.com/CodeByZach/pace/)
23. [Uniform 2.1.2](http://pixelmatrixdesign.com)
24. [Line-icons](https://lineicons.com/)
25. [OffCanvasMenuEffects](https://tympanus.net/Development/OffCanvasMenuEffects/)
26. [Waves 0.6.5](http://fian.my.id/Waves)
27. [Switchery](https://abpetkov.github.io/switchery/)
28. [3d-bold-navigation](https://codyhouse.co/gem/3d-bold-navigation)
29. [dropify 0.2.1](https://github.com/JeremyFagis/dropify)
30. [moment.js 2.10.3](https://momentjs.com)
31. [toastr](https://github.com/CodeSeven/toastr)
32. [weather-icons 1.3](http://erikflowers.github.io/weather-icons/)
33. [metrojs](http://drewgreenwell.com/projects/metrojs)
34. [chartjs 1.0.2](http://chartjs.org/)
35. Dan lain-lain...

<hr>

## Fitur

Fitur pada aplikasi ini meliputi:

1. **Halaman Depan**
   - Home
   - Gallery
   - Team
   - All Post
   - Post by Category
   - Post by Author
   - Post by Tag
   - Post by Search
   - Document
   - Contact
   - Login

2. **Halaman Dashboard Admin**
   - Dashboard
   - Post (All post, Add new, Category, Tag)
   - Inbox
   - Comment
   - Subscriber
   - Member
   - Testimonial
   - Team
   - Users
   - Settings (My Profile, Website, Home, About)
   - Logout

3. **Halaman Dashboard Author**
   - Dashboard
   - Post (All post, Add new, Category, Tag)
   - Comment
   - Settings (My Profile)
   - Logout

<hr>

## Instalasi

1. Clone repository ini melalui terminal git:
   ```sh
   git clone [https://github.com/muhammadarifs05/pmiigarut.git](https://github.com/muhammadarifs05/pmiigarut.git)

2. Jalankan MySQL (misalnya via XAMPP).
3. Buat database lokal baru (misal: pmiigarut), lalu import file .sql yang ada pada folder db.
4. Rename file env menjadi .env, lalu sesuaikan pengaturan koneksi database dan app.baseURL.
5. Jalankan perintah composer install pada terminal di root folder proyek.
6. Jalankan perintah php spark serve untuk menjalankan aplikasi lokal.

### Spesifikasi

- PHP ^7.4
- CodeIgniter 4.x
- Database MySQL atau MariaDB 5.x

## Lisensi

Project ini merupakan software yang free dan open source di bawah [lisensi MIT](LICENSE).

## Acknowledgment 

- Repositori ini diadaptasi dari source code hibah @pmiidev.