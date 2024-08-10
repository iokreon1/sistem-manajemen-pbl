

-- ==================Table: aspek_penilaian_pengampu================== 

INSERT INTO `aspek_penilaian_pengampu` (`aspek_id`, `nama_aspek`) VALUES ('1', 'Kerjasama');
INSERT INTO `aspek_penilaian_pengampu` (`aspek_id`, `nama_aspek`) VALUES ('2', 'Sikap');
INSERT INTO `aspek_penilaian_pengampu` (`aspek_id`, `nama_aspek`) VALUES ('3', 'Hasil');


-- ==================Table: aspek_penilaian_pm================== 

INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('1', 'Software', '1');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('2', 'Hardware', '1');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('3', 'Fungsional', '1');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('4', 'User-friendly', '2');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('5', 'Tata Letak atau Layout', '2');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('6', 'Usability', '2');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('7', 'Fungsionalitas', '3');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('8', 'Reliability', '3');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('9', 'Efisiensi', '3');
INSERT INTO `aspek_penilaian_pm` (`aspek_id`, `nama_aspek`, `fase_id`) VALUES ('10', 'Skill', '4');


-- ==================Table: dosen================== 

INSERT INTO `dosen` (`id_user`, `nip`, `nama_dosen`) VALUES ('3', '198810142019031007', 'Amran Yobioktabera, M.Kom.');
INSERT INTO `dosen` (`id_user`, `nip`, `nama_dosen`) VALUES ('2', '199109172022031007', 'Suko Tyas Pernanda, S.ST., M.Cs.');


-- ==================Table: dosen_pengampu================== 

INSERT INTO `dosen_pengampu` (`id_dosen_pengampu`, `project_id`, `nip`, `kode_mata_kuliah`) VALUES ('2', '21', '199109172022031007', '334-201-404');
INSERT INTO `dosen_pengampu` (`id_dosen_pengampu`, `project_id`, `nip`, `kode_mata_kuliah`) VALUES ('4', '21', '199109172022031007', '334-201-405');
INSERT INTO `dosen_pengampu` (`id_dosen_pengampu`, `project_id`, `nip`, `kode_mata_kuliah`) VALUES ('5', '26', '198810142019031007', '334-201-405');
INSERT INTO `dosen_pengampu` (`id_dosen_pengampu`, `project_id`, `nip`, `kode_mata_kuliah`) VALUES ('6', '27', '198810142019031007', '334-201-405');


-- ==================Table: fase_project================== 

INSERT INTO `fase_project` (`fase_id`, `nama_fase`) VALUES ('1', 'Conceive');
INSERT INTO `fase_project` (`fase_id`, `nama_fase`) VALUES ('2', 'Design');
INSERT INTO `fase_project` (`fase_id`, `nama_fase`) VALUES ('3', 'Implement');
INSERT INTO `fase_project` (`fase_id`, `nama_fase`) VALUES ('4', 'Operate');


-- ==================Table: kelompok================== 

INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('1', '33422106', '21', '0');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('2', '33422109', '23', '1');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('3', '33422118', '21', '0');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('4', '33422121', '23', '0');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('5', '33422122', '21', '1');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('6', '33422124', '23', '0');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('7', '6103221529', '21', '0');
INSERT INTO `kelompok` (`kelompok_id`, `nim`, `project_id`, `ketua_kelompok`) VALUES ('8', '33422109', '21', '0');


-- ==================Table: mahasiswa================== 

INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('202252007', 'Yohana Mustika', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('32022161016', 'Muhammad Firiadi', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422102', 'Annisa Firshilla Putri', '1', '7');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422104', 'Aziz Alif Faturochman', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422105', 'Dipha WIguna', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422106', 'Divara Anaba Fathsel', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422108', 'Feri Irawan', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422109', 'Hafiz Rahman Hakim', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422110', 'Intan Adilla Kharirotul Maghfiroh', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422111', 'Isna Jesika Parasinta', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422112', 'Luqman Aldi Prawiratama', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422114', 'Muhammad Farel Aryasatya', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422115', 'Muhammad Rizky Faizzullah Sudibyo', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422116', 'Nabiha Kailang Wirakrama', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422118', 'Nasywa Aliya Shabiha', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422120', 'Riza Sukmawardani', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422121', 'Tri Susanti', '1', '6');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422122', 'Wahyu Hariyanto', '1', '5');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422123', 'Zahrah Thalib', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('33422124', 'Zuda Yudistira', '1', '');
INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi_id`, `id_users`) VALUES ('6103221529', 'Sonia Sahara', '1', '');


-- ==================Table: mata_kuliah================== 

INSERT INTO `mata_kuliah` (`kode_mata_kuliah`, `nama_matakuliah`, `nip`) VALUES ('334-201-404', 'Pemrograman Basis Data', '199109172022031007');
INSERT INTO `mata_kuliah` (`kode_mata_kuliah`, `nama_matakuliah`, `nip`) VALUES ('334-201-405', 'Pemrograman Web', '198810142019031007');


-- ==================Table: menus================== 

INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('1', 'Menu Manajemen', '#', '', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('2', 'Dashboard', 'home', 'fas fa-home', '', '1', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('3', 'Manajemen Pengguna', '#', 'fas fa-users-cog', '', '1', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('4', 'Kelola Pengguna', 'manage-user', '', '', '3', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('5', 'Kelola Role', 'manage-role', '', '', '3', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('6', 'Kelola Menu', 'manage-menu', '', '', '3', '3');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('7', 'Backup Server', '#', '', '', '0', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('8', 'Backup Database', 'dbbackup', 'fas fa-database', '', '7', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('10', 'Nilai Mingguan', 'nilai-mingguan', 'fa fa-check-square', '', '13', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('13', 'Penilaian Dosen Pengampu', 'nilaipengampu', '', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('14', 'Nilai Fase', 'manage-dosen', 'fa fa-check-square', '', '34', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('15', 'Data', '#', 'fas fa-table', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('16', 'Data PBL', 'manage-admin', 'fas fa-table', '', '15', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('34', 'PENILAIAN PM', '#', '-', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('35', 'Project', '#', 'fas fa-book-open', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('36', 'Project', 'manage-project', 'fas fa-book-open', '', '35', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('37', 'Milestone', '#', 'fas fa-tasks', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('38', 'Milestone', 'manage-milestone', 'fas fa-tasks', '', '37', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('39', 'Penilaian Dosen', '#', 'fa fa-check-square', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('40', 'Nilai Mingguan', 'manage-dosen', 'fa fa-check-square', '', '39', '1');


-- ==================Table: migrations================== 

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2024_01_01_234158_create_menus_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2024_02_02_053619_create_permission_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2024_02_03_232722_create_role_has_menus_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2024_02_03_235312_add_menu_id_on_permission', '1');


-- ==================Table: milestones================== 

INSERT INTO `milestones` (`milestone_id`, `nama_milestone`, `start`, `deadline`, `project_id`) VALUES ('1', 'Buat RPP', '2024-05-13 06:30:00', '2024-05-27 00:00:00', '23');
INSERT INTO `milestones` (`milestone_id`, `nama_milestone`, `start`, `deadline`, `project_id`) VALUES ('3', 'Apa', '2024-05-01 00:00:00', '2024-05-10 00:00:00', '21');
INSERT INTO `milestones` (`milestone_id`, `nama_milestone`, `start`, `deadline`, `project_id`) VALUES ('4', 'Buat RPP ya', '2024-06-04 00:00:00', '2024-06-29 00:00:00', '23');


-- ==================Table: model_has_roles================== 

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('1', 'App\\Models\\User', '1');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\\Models\\User', '2');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\\Models\\User', '3');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '4');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('4', 'App\\Models\\User', '5');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('4', 'App\\Models\\User', '6');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('4', 'App\\Models\\User', '7');


-- ==================Table: nilai_harian_pengampu================== 

INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('1', '334-201-404', '33422106', '6', '21', '1', '88');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('2', '334-201-404', '33422106', '6', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('3', '334-201-404', '33422106', '6', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('4', '334-201-404', '33422118', '6', '21', '1', '90');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('5', '334-201-404', '33422118', '6', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('6', '334-201-404', '33422118', '6', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('7', '334-201-404', '33422122', '6', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('8', '334-201-404', '33422122', '6', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('9', '334-201-404', '33422122', '6', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('10', '334-201-404', '6103221529', '6', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('11', '334-201-404', '6103221529', '6', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('12', '334-201-404', '6103221529', '6', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('13', '334-201-404', '33422109', '6', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('14', '334-201-404', '33422109', '6', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('15', '334-201-404', '33422109', '6', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('61', '334-201-404', '33422106', '4', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('62', '334-201-404', '33422106', '4', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('63', '334-201-404', '33422106', '4', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('64', '334-201-404', '33422118', '4', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('65', '334-201-404', '33422118', '4', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('66', '334-201-404', '33422118', '4', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('67', '334-201-404', '33422122', '4', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('68', '334-201-404', '33422122', '4', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('69', '334-201-404', '33422122', '4', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('70', '334-201-404', '6103221529', '4', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('71', '334-201-404', '6103221529', '4', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('72', '334-201-404', '6103221529', '4', '21', '3', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('73', '334-201-404', '33422109', '4', '21', '1', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('74', '334-201-404', '33422109', '4', '21', '2', '80');
INSERT INTO `nilai_harian_pengampu` (`nilai_pengampu_id`, `kode_mata_kuliah`, `nim`, `minggu`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('75', '334-201-404', '33422109', '4', '21', '3', '80');


-- ==================Table: nilai_pm================== 

INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('1', '198810142019031007', '33422106', '21', '1', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('2', '198810142019031007', '33422106', '21', '2', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('3', '198810142019031007', '33422106', '21', '3', '89');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('4', '198810142019031007', '33422118', '21', '1', '90');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('5', '198810142019031007', '33422118', '21', '2', '30');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('6', '198810142019031007', '33422118', '21', '3', '10');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('7', '198810142019031007', '33422122', '21', '1', '33');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('8', '198810142019031007', '33422122', '21', '2', '44');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('9', '198810142019031007', '33422122', '21', '3', '60');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('10', '198810142019031007', '6103221529', '21', '1', '78');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('11', '198810142019031007', '6103221529', '21', '2', '23');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('12', '198810142019031007', '6103221529', '21', '3', '56');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('25', '198810142019031007', '33422106', '21', '4', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('26', '198810142019031007', '33422106', '21', '5', '90');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('27', '198810142019031007', '33422106', '21', '6', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('28', '198810142019031007', '33422118', '21', '4', '78');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('29', '198810142019031007', '33422118', '21', '5', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('30', '198810142019031007', '33422118', '21', '6', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('31', '198810142019031007', '33422122', '21', '4', '70');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('32', '198810142019031007', '33422122', '21', '5', '78');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('33', '198810142019031007', '33422122', '21', '6', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('34', '198810142019031007', '6103221529', '21', '4', '89');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('35', '198810142019031007', '6103221529', '21', '5', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('36', '198810142019031007', '6103221529', '21', '6', '90');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('37', '198810142019031007', '33422109', '21', '4', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('38', '198810142019031007', '33422109', '21', '5', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('39', '198810142019031007', '33422109', '21', '6', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('40', '198810142019031007', '33422106', '21', '7', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('41', '198810142019031007', '33422106', '21', '8', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('42', '198810142019031007', '33422106', '21', '9', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('43', '198810142019031007', '33422118', '21', '7', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('44', '198810142019031007', '33422118', '21', '8', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('45', '198810142019031007', '33422118', '21', '9', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('46', '198810142019031007', '33422122', '21', '7', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('47', '198810142019031007', '33422122', '21', '8', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('48', '198810142019031007', '33422122', '21', '9', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('49', '198810142019031007', '6103221529', '21', '7', '88');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('50', '198810142019031007', '6103221529', '21', '8', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('51', '198810142019031007', '6103221529', '21', '9', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('52', '198810142019031007', '33422109', '21', '7', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('53', '198810142019031007', '33422109', '21', '8', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('54', '198810142019031007', '33422109', '21', '9', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('217', '198810142019031007', '33422109', '21', '1', '80');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('218', '198810142019031007', '33422109', '21', '2', '90');
INSERT INTO `nilai_pm` (`nilai_pm_id`, `nip`, `nim`, `project_id`, `aspek_id`, `nilai_aspek`) VALUES ('219', '198810142019031007', '33422109', '21', '3', '80');


-- ==================Table: nilai_ujian================== 

INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422106', '334-201-404', '21', 'UAS', '1', '90');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422106', '334-201-404', '21', 'UTS', '1', '99');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422106', '334-201-404', '21', 'UAS', '2', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422106', '334-201-404', '21', 'UTS', '2', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422106', '334-201-404', '21', 'UAS', '3', '70');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422106', '334-201-404', '21', 'UTS', '3', '70');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422109', '334-201-404', '21', 'UAS', '1', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422109', '334-201-404', '21', 'UTS', '1', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422109', '334-201-404', '21', 'UAS', '2', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422109', '334-201-404', '21', 'UTS', '2', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422109', '334-201-404', '21', 'UAS', '3', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422109', '334-201-404', '21', 'UTS', '3', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422118', '334-201-404', '21', 'UAS', '1', '60');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422118', '334-201-404', '21', 'UTS', '1', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422118', '334-201-404', '21', 'UAS', '2', '60');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422118', '334-201-404', '21', 'UTS', '2', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422118', '334-201-404', '21', 'UAS', '3', '60');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422118', '334-201-404', '21', 'UTS', '3', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422122', '334-201-404', '21', 'UAS', '1', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422122', '334-201-404', '21', 'UTS', '1', '50');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422122', '334-201-404', '21', 'UAS', '2', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422122', '334-201-404', '21', 'UTS', '2', '50');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422122', '334-201-404', '21', 'UAS', '3', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('33422122', '334-201-404', '21', 'UTS', '3', '50');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('6103221529', '334-201-404', '21', 'UAS', '1', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('6103221529', '334-201-404', '21', 'UTS', '1', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('6103221529', '334-201-404', '21', 'UAS', '2', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('6103221529', '334-201-404', '21', 'UTS', '2', '88');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('6103221529', '334-201-404', '21', 'UAS', '3', '80');
INSERT INTO `nilai_ujian` (`nim`, `kode_mata_kuliah`, `project_id`, `tipe_ujian`, `aspek_id`, `nilai_aspek`) VALUES ('6103221529', '334-201-404', '21', 'UTS', '3', '80');


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

INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('21', 'Sistem Informasi Manajemen PBL 2 (modul penilaian PBL)', '199109172022031007', '2022/2023', '3', '1', '1', 'Aplikasi Kesehatan Mata 2', '12 Apr 2024 - 21 Mei 2024', 'PBL-202302-05');
INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('23', 'Sistem Informasi Manajemen PBL 2 (modul penilaian PBL)', '199109172022031007', '2023/2024', '4', '1', '1', 'Aplikasi Kesehatan Mata 3', '2 Apr 2024 - 13 Apr 2024', 'PBL-202302-08');
INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('26', 'Aplikasi BMI', '199109172022031007', '2023/2024', '3', '1', '1', 'Aplikasi Kesehatan Badan', '9 Mei 2024 - 11 Mei 2024', 'PBL-202302-07');
INSERT INTO `projects` (`project_id`, `judul_project`, `nip`, `tahun_akademik`, `semester`, `jenis_usulan`, `tipe_pendanaan`, `desain_umum`, `waktu_pengerjaan`, `kode_pbl`) VALUES ('27', 'SIPMAS', '198810142019031007', '2023/2024', '4', '1', '1', 'YEY', '15 Jun 2024 - 15 Jul 2024', 'PBL-202302-21');


-- ==================Table: roles================== 

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'superadmin', 'web', '2024-03-13 14:58:28', '2024-03-13 14:58:28');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('2', 'dosen', 'web', '2024-03-27 09:07:49', '2024-03-27 09:08:06');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('3', 'admin', 'web', '2024-03-27 11:45:30', '2024-03-27 11:45:30');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('4', 'mahasiswa', 'web', '2024-05-02 13:06:49', '2024-05-02 13:06:49');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('5', 'ketua', 'web', '2024-05-13 09:43:14', '2024-05-13 09:43:14');


-- ==================Table: role_has_menus================== 

INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('53', '15', '3');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('54', '16', '3');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('93', '1', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('94', '2', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('95', '3', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('96', '4', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('97', '5', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('98', '6', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('99', '7', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('100', '8', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('101', '15', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('102', '16', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('103', '34', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('104', '14', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('105', '13', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('106', '10', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('107', '34', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('108', '14', '2');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('109', '35', '4');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('110', '36', '4');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('111', '35', '5');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('112', '36', '5');


-- ==================Table: role_has_permissions================== 

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('2', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('3', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('4', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('5', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('6', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('7', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('8', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('9', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('11', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('12', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('13', '1');


-- ==================Table: users================== 

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Super Admin', 'superadmin@gmail.com', '2024-03-13 14:58:28', '$2y$10$zIRenVXSeXeTJ8Q8R6Nnxe7lhdpJWaTdrYqobq4gtSmuqrL9yhB22', 'RaywdZFXd5JDrmBklZP46PW39k5MgBQ7rxPFzefeDmfdsYmqzQqESwm7s2S5', '2024-03-13 14:58:28', '2024-03-13 14:58:28');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Suko Tyas', 'sukotyasp@gmail.com', '', '$2y$10$Y81p0uzySaPxQ6no/qiwaOHbNpAKLsEiok.fP/nuk/SvasNiflqAC', '', '2024-03-27 08:38:24', '2024-03-27 08:38:24');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('3', 'Amran Yobioktabera', 'amrany@gmail.com', '', '$2y$10$yvaOzArI9mbs7WfDvgPJTuBbqYLQsdqBhwxLhAPkT8ix36r93LI9a', '', '2024-03-27 08:39:12', '2024-03-27 09:15:00');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('4', 'Admin', 'admin@gmail.com', '2024-03-27 11:46:02', '$2y$10$whEEizcF0bHzzj/uyd1VxOAJ6QrlMEXRKwNHRaWz1Srzrfs6zGjEO', '', '2024-03-27 11:46:02', '2024-03-27 11:46:02');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('5', 'Wahyu Hariyanto', 'wahyuhariyanto@gmail.com', '2024-06-04 19:27:30', '$2y$10$nDScB/NqmLEG/aFSAQomvO1B9yfvY8hiy8S5jRhKkgwCsEOWq7Yka', '', '2024-04-29 11:53:21', '2024-06-04 19:27:30');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('6', 'Tri Susanti', 'trisusanti@gmail.com', '2024-05-05 11:38:03', '$2y$10$fBs.df9WDc74Gw0NLNG./eyQGUH9KzJxyM2D2T2S/O10PNdT9lUjW', '', '2024-04-29 19:47:43', '2024-05-05 11:38:03');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('7', 'Annisa Firshilla Putri', 'annisafirshilla@gmail.com', '2024-06-04 19:28:23', '$2y$10$csppbwmSf.U1rnhptylOEuycaLlIGCMmbi1Dr7EOeYje2ime6yDyC', '', '2024-06-04 19:28:03', '2024-06-04 19:28:23');


-- ==================Table: waktu================== 

INSERT INTO `waktu` (`project_id`, `tanggal_mulai`, `tanggal_akhir`) VALUES ('21', '2024-04-12 00:00:00', '2024-04-20 00:00:00');
INSERT INTO `waktu` (`project_id`, `tanggal_mulai`, `tanggal_akhir`) VALUES ('23', '2024-04-02 00:00:00', '2024-04-13 00:00:00');
INSERT INTO `waktu` (`project_id`, `tanggal_mulai`, `tanggal_akhir`) VALUES ('26', '2024-05-09 00:00:00', '2024-05-11 00:00:00');
INSERT INTO `waktu` (`project_id`, `tanggal_mulai`, `tanggal_akhir`) VALUES ('27', '2024-06-15 00:00:00', '2024-07-15 00:00:00');
