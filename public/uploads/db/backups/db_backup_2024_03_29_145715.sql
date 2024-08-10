

-- ==================Table: aspek_penilaian_pm================== 

INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('1', 'Software', '1');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('2', 'Hardware', '1');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('3', 'Fungsional', '1');


-- ==================Table: dosen================== 

INSERT INTO `dosen` (`id_user`, `nip`, `nama_dosen`) VALUES ('3', '198810142019031007', 'Amran Yobioktabera, M.Kom.');
INSERT INTO `dosen` (`id_user`, `nip`, `nama_dosen`) VALUES ('2', '199109172022031007', 'Suko Tyas Pernanda, S.ST., M.Cs.');


-- ==================Table: fase_project================== 

INSERT INTO `fase_project` (`fase_id`, `nama_fase`) VALUES ('1', 'Conceive');
INSERT INTO `fase_project` (`fase_id`, `nama_fase`) VALUES ('2', 'Design');


-- ==================Table: mahasiswa================== 

INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('33422106', 'Divara Anaba Fathsel', '1');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('33422109', 'Hafiz Rahman Hakim', '1');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('33422118', 'Nasywa Aliya Shabiha', '1');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('33422121', 'Tri Susanti', '1');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('33422122', 'Wahyu Hariyanto', '1');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('33422124', 'Zuda Yudistira', '1');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`) VALUES ('6103221529', 'Sonia Sahara', '1');


-- ==================Table: menus================== 

INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('2', 'Dashboard', 'home', 'fas fa-home', '', '1', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('3', 'Manajemen Pengguna', '#', 'fas fa-users-cog', '', '1', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('4', 'Kelola Pengguna', 'manage-user', '', '', '3', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('5', 'Kelola Role', 'manage-role', '', '', '3', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('6', 'Kelola Menu', 'manage-menu', '', '', '3', '3');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('7', 'Backup Server', '#', '', '', '0', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('8', 'Backup Database', 'dbbackup', 'fas fa-database', '', '7', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('9', 'Penilaian PM', '#', 'fa fa-check-square', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('10', 'Nilai Mingguan', 'nilai-mingguan', 'fa fa-check-square', '', '13', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('13', 'Penilaian Dosen Pengampu', 'nilaipengampu', '', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('14', 'Nilai Fase', 'nilaifase', 'fa fa-check-square', '', '9', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('15', 'Data', '#', 'fas fa-table', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('16', 'Data PBL', 'manage-admin', 'fas fa-table', '', '15', '1');


-- ==================Table: migrations================== 

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2024_01_01_234158_create_menus_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2024_02_02_053619_create_permission_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2024_02_03_232722_create_role_has_menus_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2024_02_03_235312_add_menu_id_on_permission', '1');


-- ==================Table: model_has_roles================== 

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('1', 'App\\Models\\User', '1');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\\Models\\User', '3');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '4');


-- ==================Table: nilai_pm================== 

INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`, `fase_id`) VALUES ('1', '198810142019031007', '33422106', '1', '1', '99', '1');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`, `fase_id`) VALUES ('2', '198810142019031007', '33422106', '1', '2', '99', '1');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`, `fase_id`) VALUES ('3', '198810142019031007', '33422106', '1', '3', '99', '1');


-- ==================Table: permissions================== 

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('1', 'create_user', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('2', 'read_user', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('3', 'update_user', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('4', 'delete_user', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('5', 'create_role', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('6', 'read_role', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('7', 'update_role', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('8', 'delete_role', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('9', 'create_menu', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('10', 'read_menu', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('11', 'update_menu', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('12', 'delete_menu', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('13', 'backup_database', 'web', '2024-03-13 14:58:27', '2024-03-13 14:58:27', '8');


-- ==================Table: prodi================== 

INSERT INTO `prodi` (`prodi_id`, `nama_prodi`) VALUES ('1', 'D3 Teknik Informatika');


-- ==================Table: projects================== 

INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('1', 'Sistem Informasi Manajemen PBL 2 (modul penilaian & rekapitulasi)', '198810142019031007', '2021/2023', '4', '2', '1', 'Aplikasi PBL', '15 Mar 2024 - 30 Mar 2024', 'PBL-202302-05');
INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('2', 'Sistem Informasi Manajemen PBL 2 (modul penilaian & rekapitulasi)', '198810142019031007', '2023/2024', '2', '1', '1', 'Aplikasi', '20 Mar 2024 - 26 Mar 2024', 'PBL-202302-05');
INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('3', 'Sistem Informasi Manajemen PBL 2 (modul penilaian ...', '198810142019031007', '2022/2023', '3', '1', '1', 'Aplikasi Kesehatan', '27 Mar 2024 - 26 Mar 2024', 'PBL-202302-04');


-- ==================Table: roles================== 

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'superadmin', 'web', '2024-03-13 14:58:28', '2024-03-13 14:58:28');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('2', 'dosen', 'web', '2024-03-27 09:07:49', '2024-03-27 09:08:06');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('3', 'admin', 'web', '2024-03-27 11:45:30', '2024-03-27 11:45:30');


-- ==================Table: role_has_menus================== 

INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('35', '9', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('36', '14', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('37', '13', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('38', '10', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('53', '15', '3');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('54', '16', '3');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('56', '7', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('57', '8', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('58', '9', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('59', '14', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('60', '15', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('61', '16', '1');


-- ==================Table: role_has_permissions================== 

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('13', '1');


-- ==================Table: users================== 

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Super Admin', 'superadmin@gmail.com', '2024-03-13 14:58:28', '$2y$10$zIRenVXSeXeTJ8Q8R6Nnxe7lhdpJWaTdrYqobq4gtSmuqrL9yhB22', 'i1KcxScaPAgtIRxRTxXpBRFf27KegQHG96pASZO6d64hHBsBUwHuW20yvvKI', '2024-03-13 14:58:28', '2024-03-13 14:58:28');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Suko Tyas', 'sukotyasp@gmail.com', '', '$2y$10$Y81p0uzySaPxQ6no/qiwaOHbNpAKLsEiok.fP/nuk/SvasNiflqAC', '', '2024-03-27 08:38:24', '2024-03-27 08:38:24');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('3', 'Amran Yobioktabera', 'amrany@gmail.com', '', '$2y$10$yvaOzArI9mbs7WfDvgPJTuBbqYLQsdqBhwxLhAPkT8ix36r93LI9a', '', '2024-03-27 08:39:12', '2024-03-27 09:15:00');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('4', 'Admin', 'admin@gmail.com', '2024-03-27 11:46:02', '$2y$10$whEEizcF0bHzzj/uyd1VxOAJ6QrlMEXRKwNHRaWz1Srzrfs6zGjEO', '', '2024-03-27 11:46:02', '2024-03-27 11:46:02');
