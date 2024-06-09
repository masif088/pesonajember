<?php

namespace Database\Seeders;

use App\Models\AccountCategory;
use App\Models\AccountGroup;
use App\Models\AccountName;
use App\Models\AccountOpeningBalance;
use App\Models\AccountType;
use App\Models\Bank;
use App\Models\CompanyAssetCategory;
use App\Models\Customer;
use App\Models\GeneralInfo;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialMutation;
use App\Models\MaterialMutationStatus;
use App\Models\PaymentModel;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\ProductAdditionalCost;
use App\Models\ProductCategory;
use App\Models\ProductMaterial;
use App\Models\ProductProcesses;
use App\Models\ProductProcessTags;
use App\Models\Shipper;
use App\Models\Status;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use App\Models\SubmissionStatus;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use App\Models\TransactionDetailType;
use App\Models\TransactionStatusType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Test User',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'role' => 1,
            'position' => 'Pemilik',
        ]);

        SupplierCategory::create([
            'title' => 'Material benang',
        ]);

        Shipper::create(['title' => 'JNE',
            'note' => '', 'location' => '', 'phone' => '']);

        Status::create([
            'title' => 'Aktif',
        ]);
        Status::create([
            'title' => 'Tidak Aktif',
        ]);

        Supplier::create([
            'supplier_category_id' => 1,
            'title' => 'Toko Benang Berjaya',
            'name' => 'Toko Benang Berjaya',
            'email' => 'benang@gmail.com',
            'phone' => '087123123123',
        ]);
        MaterialMutationStatus::create([
            'title' => 'Produksi',
            'operation' => -1,

        ]);
        MaterialMutationStatus::create([
            'title' => 'Pembelian',
            'operation' => 1,

        ]);
        MaterialMutationStatus::create([
            'title' => 'Dibuang/residu',
            'operation' => -1,

        ]);

        MaterialCategory::create([
            'title' => 'Kain',
        ]);
        MaterialCategory::create([
            'title' => 'Tali',
        ]);
        MaterialCategory::create([
            'title' => 'Aksesoris',
        ]);

        Material::create([
            'title' => 'Benang Kuning',
            'note' => '',
            'stock' => 100,
            'unit' => 'cm',
            'value' => 100000,
            'supplier_id' => 1,
            'status_id' => 1,
            'code' => 'Bk2',
            'material_category_id' => 1,
        ]);

        Material::create([
            'title' => 'Benang Merah',
            'note' => '',
            'stock' => 100,
            'unit' => 'cm',
            'value' => 100000,
            'supplier_id' => 1,
            'status_id' => 1,
            'code' => 'Bk2',
            'material_category_id' => 1,
        ]);
        MaterialMutation::create([
            'material_id' => 2,
            'material_mutation_status_id' => 1,
            'reference' => 'produksi tanggal 04/05/2024',
            'note' => '',
            'amount' => 10,
            'stock' => 90,
        ]);

        SubmissionStatus::create([
            'title' => 'ditinjau',
        ]);
        SubmissionStatus::create([
            'title' => 'dibatalkan',
        ]);
        SubmissionStatus::create([
            'title' => 'disetujui',
        ]);

        Submission::create([
            'user_id' => 1,
            'submission_status_id' => 1,
            'title' => 'Pengajuan Benang',
            'note' => '',
            'shopping_note' => '',
        ]);
        SubmissionDetail::create([
            'submission_id' => 1,
            'material_id' => 1,
            'amount' => 10,
            'price' => 10000,
        ]);
        Bank::create([
            'bank_name' => 'BRI',
            'account_number' => '9000',
            'account_in_name' => 'asif',
            'note' => '',
            'status_id' => 1,
        ]);

        ProductCategory::create([
            'title' => 'Sling Bag',

        ]);
        ProductCategory::create([
            'title' => 'Totebag',

        ]);

        ProductProcessTags::create([
            'title' => 'Potong',
        ]);
        ProductProcessTags::create([
            'title' => 'Jahit',
        ]);
        ProductProcessTags::create([
            'title' => 'DTF',
        ]);
        ProductProcessTags::create([
            'title' => 'Sablon',
        ]);
        ProductProcessTags::create([
            'title' => 'Bordir',
        ]);

        AccountType::create([
            'title' => 'NERACA',
            'code' => 'NERACA',
        ]);

        AccountType::create([
            'title' => 'LABA/RUGI',
            'code' => 'LABA/RUGI',
        ]);

        AccountGroup::create([
            'title' => 'AKTIVA LANCAR',
            'parent' => 'AKTIVA',
            'code' => 1,
            'account_type_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 1,
            'title' => 'Kas',
            'code' => '1.01',
        ]);
        AccountName::create([
            'account_category_id' => 1,
            'level' => 'DR',
            'code' => '1.01.001',
            'title' => 'Kas Kecil',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 1,
            'level' => 'DR',
            'code' => '1.01.002',
            'title' => 'Kas Besar',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 1,
            'title' => 'Bank',
            'code' => '1.02',
        ]);
        AccountName::create([
            'account_category_id' => 2,
            'level' => 'DR',
            'code' => '1.02.001',
            'title' => 'Bank BCA A/C No. 4480364029',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 2,
            'level' => 'DR',
            'code' => '1.02.002',
            'title' => 'Bank BCA A/C No. 4480655724 (Tabungan)',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 2,
            'level' => 'DR',
            'code' => '1.02.003',
            'title' => 'Bank Mandiri',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 2,
            'level' => 'DR',
            'code' => '1.02.004',
            'title' => 'Bank Mandiri',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 1,
            'title' => 'Piutang usaha',
            'code' => '1.03',
        ]);
        AccountName::create([
            'account_category_id' => 3,
            'level' => 'DR',
            'code' => '1.03.101',
            'title' => 'Piutang UD. ENIN',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 3,
            'level' => 'DR',
            'code' => '1.03.102',
            'title' => 'Piutang UD. BLOOM',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 3,
            'level' => 'DR',
            'code' => '1.03.103',
            'title' => 'Piutang CV. UB MERCH',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 3,
            'level' => 'DR',
            'code' => '1.03.104',
            'title' => 'Piutang Pak anwar',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 3,
            'level' => 'DR',
            'code' => '1.03.105',
            'title' => 'Piutang Mas wahyu',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 1,
            'title' => 'Persediaan Bahan Baku',
            'code' => '1.04',
        ]);
        AccountName::create([
            'account_category_id' => 4,
            'level' => 'DR',
            'code' => '1.04.001',
            'title' => 'Persed. Kain',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 4,
            'level' => 'DR',
            'code' => '1.04.002',
            'title' => 'Persed. Tali',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 4,
            'level' => 'DR',
            'code' => '1.04.003',
            'title' => 'Persed. Asesoris',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 1,
            'title' => 'Piutang lain-lain',
            'code' => '1.06',
        ]);
        AccountName::create([
            'account_category_id' => 5,
            'level' => 'DR',
            'code' => '1.06.001',
            'title' => 'Piutang Karyawan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 5,
            'level' => 'DR',
            'code' => '1.06.002',
            'title' => 'Piutang (topup shopee)',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 1,
            'title' => 'Biaya Dibayar Di Muka',
            'code' => '1.07',
        ]);
        AccountName::create([
            'account_category_id' => 6,
            'level' => 'DR',
            'code' => '1.07.001',
            'title' => 'Sewa DDM',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 6,
            'level' => 'DR',
            'code' => '1.07.002',
            'title' => 'Asuransi DDM',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 6,
            'level' => 'DR',
            'code' => '1.07.003',
            'title' => 'Uang Muka Pembelian',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'AKTIVA TETAP',
            'parent' => 'AKTIVA',
            'code' => 2,
            'account_type_id' => 1,
        ]);
        AccountCategory::create([
            'account_group_id' => 2,
            'title' => 'Harga Perolehan',
            'code' => '2.01',
        ]);
        AccountName::create([
            'account_category_id' => 7,
            'level' => 'DR',
            'code' => '2.01.001',
            'title' => 'Tanah',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 7,
            'level' => 'DR',
            'code' => '2.01.002',
            'title' => 'Bangunan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 7,
            'level' => 'DR',
            'code' => '2.01.003',
            'title' => 'Mesin',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 7,
            'level' => 'DR',
            'code' => '2.01.004',
            'title' => 'Peralatan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 7,
            'level' => 'DR',
            'code' => '2.01.005',
            'title' => 'Inventaris Kantor',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 7,
            'level' => 'DR',
            'code' => '2.01.006',
            'title' => 'Kendaraan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountCategory::create([
            'account_group_id' => 2,
            'title' => 'Akumulasi Penyusutan',
            'code' => '2.02',
        ]);
        AccountName::create([
            'account_category_id' => 8,
            'level' => 'CR',
            'code' => '2.02.001',
            'title' => 'Ak. Penyus. Bangunan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 8,
            'level' => 'CR',
            'code' => '2.02.002',
            'title' => 'Ak. Penyus. Mesin',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 8,
            'level' => 'CR',
            'code' => '2.02.003',
            'title' => 'Ak. Penyus. Peralatan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 8,
            'level' => 'CR',
            'code' => '2.02.004',
            'title' => 'Ak. Penyus. Inventaris Kantor',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 8,
            'level' => 'CR',
            'code' => '2.02.005',
            'title' => 'Ak. Penyus. Kendaraan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'KEWAJIBAN JK PENDEK',
            'parent' => 'KEWAJIBAN & EKUITAS',
            'code' => 4,
            'account_type_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 3,
            'title' => 'Hutang Usaha',
            'code' => '4.01',
        ]);
        AccountName::create([
            'account_category_id' => 9,
            'level' => 'CR',
            'code' => '4.01.001',
            'title' => 'Hutang Abidah',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 9,
            'level' => 'CR',
            'code' => '4.01.002',
            'title' => 'Hutang Kun Sentanawan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 9,
            'level' => 'CR',
            'code' => '4.01.004',
            'title' => '...',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 9,
            'level' => 'CR',
            'code' => '4.01.003',
            'title' => '...',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 3,
            'title' => 'Hutang Gaji',
            'code' => '4.02',
        ]);
        AccountName::create([
            'account_category_id' => 10,
            'level' => 'CR',
            'code' => '4.02.001',
            'title' => 'Hutang Gaji',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 3,
            'title' => 'Hutang Lain-lain',
            'code' => '4.03',
        ]);

        AccountName::create([
            'account_category_id' => 11,
            'level' => 'CR',
            'code' => '4.03.001',
            'title' => 'Hutang ...',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 11,
            'level' => 'CR',
            'code' => '4.03.002',
            'title' => 'Hutang lain-lain',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 3,
            'title' => 'Pendapatan diterima dimuka',
            'code' => '4.04',
        ]);
        AccountName::create([
            'account_category_id' => 12,
            'level' => 'CR',
            'code' => '4.04.001',
            'title' => 'Pendapatan diterima dimuka',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'KEWAJIBAN JK PANJANG',
            'parent' => 'KEWAJIBAN & EKUITAS',
            'code' => 5,
            'account_type_id' => 1,
        ]);
        AccountCategory::create([
            'account_group_id' => 4,
            'title' => 'Hutang Jangka Panjang',
            'code' => '5.01',
        ]);
        AccountName::create([
            'account_category_id' => 13,
            'level' => 'CR',
            'code' => '5.01.001',
            'title' => 'Hutang Bank',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 13,
            'level' => 'CR',
            'code' => '5.01.002',
            'title' => 'Hutang Pihak III',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'EKUITAS',
            'parent' => 'KEWAJIBAN & EKUITAS',
            'code' => 6,
            'account_type_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 5,
            'title' => 'Modal',
            'code' => '6.01',
        ]);
        AccountName::create([
            'account_category_id' => 14,
            'level' => 'CR',
            'code' => '6.01.001',
            'title' => 'Modal Kun Sentanawan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountCategory::create([
            'account_group_id' => 5,
            'title' => 'Saldo Laba',
            'code' => '6.02',
        ]);
        AccountName::create([
            'account_category_id' => 15,
            'level' => 'CR',
            'code' => '6.02.001',
            'title' => 'Saldo laba',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 15,
            'level' => 'CR',
            'code' => '6.02.002',
            'title' => 'Laba-Rugi Tahun Berjalan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 15,
            'level' => 'CR',
            'code' => '6.02.003',
            'title' => 'Laba-Rugi Bulan Berjalan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 5,
            'title' => 'Prive/Dividen',
            'code' => '6.03',
        ]);
        AccountName::create([
            'account_category_id' => 16,
            'level' => 'CR',
            'code' => '6.03.001',
            'title' => 'Dividen Kun Sentanawan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'PENDAPATAN',
            'parent' => 'PENDAPATAN',
            'code' => 7,
            'account_type_id' => 2,
        ]);

        AccountCategory::create([
            'account_group_id' => 6,
            'title' => 'Pendapatan',
            'code' => '7.01',
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.001',
            'title' => 'Penjualan Slingbag',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.002',
            'title' => 'Penjualan Totebag',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.003',
            'title' => 'Penjualan Ransel',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.004',
            'title' => 'Penjualan Waistbag',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.005',
            'title' => 'Penjualan Lain-lain',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.201',
            'title' => 'Retur Penjualan Slingbag',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.202',
            'title' => 'Retur Penjualan Totebag',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.203',
            'title' => 'Retur Penjualan Ransel',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.204',
            'title' => 'Retur Penjualan Waistbag',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.205',
            'title' => 'Retur Penjualan Lain-lain',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 17,
            'level' => 'CR',
            'code' => '7.01.400',
            'title' => 'Potongan Penjualan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 6,
            'title' => 'Pendapatan lain-lain',
            'code' => '7.02',
        ]);
        AccountName::create([
            'account_category_id' => 18,
            'level' => 'CR',
            'code' => '7.01.001',
            'title' => 'Pendapatan bunga',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 18,
            'level' => 'CR',
            'code' => '7.01.002',
            'title' => 'Pendapatan lainnya',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'BIAYA OPERATIONAL',
            'parent' => 'KEWAJIBAN & EKUITAS',
            'code' => 8,
            'account_type_id' => 2,
        ]);

        AccountCategory::create([
            'account_group_id' => 7,
            'title' => 'Biaya operational',
            'code' => '8.01',
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.001',
            'title' => 'Bi Gaji, THR, & Bonus Bag. Produksi',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.002',
            'title' => 'Bi Gaji, THR, & Bonus Bag. Operasional',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.003',
            'title' => 'Bi Listrik',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.004',
            'title' => 'Bi ATK/Stationary, PBB',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.005',
            'title' => 'Bi Perdin, BBM, ongkir, & Transport',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.006',
            'title' => 'Bi Kebutuhan Rumah Tangga',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.007',
            'title' => 'Bi Promosi',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.008',
            'title' => 'Pemel. Gedung',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.009',
            'title' => 'Retribusi & Iuran',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.010',
            'title' => 'Bi Operasional Lainnya',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.011',
            'title' => 'Bi Telpon',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.012',
            'title' => 'Bi WiFi',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.013',
            'title' => 'Bi Pemel. Mesin & Peralatan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.014',
            'title' => 'Bi Pemel. Invent, Perlengk',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.015',
            'title' => 'Bi Pemel. Kendaraan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.016',
            'title' => 'Bi Sumbangan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.017',
            'title' => 'Bi Entertainment',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.018',
            'title' => 'Bi Seragam',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 19,
            'level' => 'CR',
            'code' => '8.01.019',
            'title' => 'Bi Print DTF, Sablon, dan Bordir',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 7,
            'title' => 'Bi Non Operasional',
            'code' => '8.02',
        ]);
        AccountName::create([
            'account_category_id' => 20,
            'level' => 'CR',
            'code' => '8.02.001',
            'title' => 'Bi Sewa Lahan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 20,
            'level' => 'CR',
            'code' => '8.02.002',
            'title' => 'Bi Penyus. Bangunan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 20,
            'level' => 'CR',
            'code' => '8.02.003',
            'title' => 'Bi Penyus. Mesin',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 20,
            'level' => 'CR',
            'code' => '8.02.004',
            'title' => 'Bi Penyus. Peralatan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 20,
            'level' => 'CR',
            'code' => '8.02.005',
            'title' => 'Bi Penyus. Inventaris Kantor',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 20,
            'level' => 'CR',
            'code' => '8.02.006',
            'title' => 'Bi Penyus. Kendaraan',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountCategory::create([
            'account_group_id' => 7,
            'title' => 'Bi Lain-lain',
            'code' => '8.05',
        ]);
        AccountName::create([
            'account_category_id' => 21,
            'level' => 'CR',
            'code' => '8.05.001',
            'title' => 'Bi Bank',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 21,
            'level' => 'CR',
            'code' => '8.05.002',
            'title' => 'Bi Lain-lain',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        AccountGroup::create([
            'title' => 'HPP',
            'parent' => 'HPP',
            'code' => 9,
            'account_type_id' => 2,
        ]);

        AccountCategory::create([
            'account_group_id' => 8,
            'title' => 'HPP',
            'code' => '9.01',
        ]);
        AccountName::create([
            'account_category_id' => 22,
            'level' => 'CR',
            'code' => '9.01.001',
            'title' => 'HPP Kain',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 22,
            'level' => 'CR',
            'code' => '9.01.002',
            'title' => 'HPP Tali',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);
        AccountName::create([
            'account_category_id' => 22,
            'level' => 'CR',
            'code' => '9.01.003',
            'title' => 'HPP Asesoris',
            'additional_cost' => 0,
            'status_id' => 1,
        ]);

        //        AccountName::create([
        //            'account_category_id' => 1,
        //            'code' => '8.0.1',
        //            'level' => 'DR',
        //            'title' => 'Bayar Penjahit Pak Sudi',
        //            'note' => '',
        //            'additional_cost' => 1,
        //        ]);

        Product::create([
            'code' => 'P01',
            'title' => 'Product 1',
            'size' => '4x4x5',
            'price' => 200000,
            'stock' => 0,
            'note' => '',
            'product_category_id' => 1,
            'status_id' => 1,
            'display_status' => 1,
            'photo_product' => '',
            'custom_status' => 1,
        ]);

        ProductProcesses::create([
            'product_id' => 1,
            'product_process_tag_id' => 1,
        ]);

        ProductMaterial::create([
            'product_id' => 1,
            'size' => 2,
            'amount' => 2,
            'note' => '2cmx1cm seng genah',
            'material_id' => 1,
        ]);

        ProductAdditionalCost::create([
            'product_id' => 1,
            'price' => 10000,
            'amount' => 2,
            'note' => '',
            'account_name_id' => 1,
        ]);

        TransactionStatusType::create([
            'title' => 'Pesanan Baru',
            'order' => 1,
        ]);
        TransactionStatusType::create([
            'title' => 'DP Diterima',
            'order' => 2,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Mockup)',
            'order' => 3,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Pola)',
            'order' => 4,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Sampel)',
            'order' => 5,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Potong)',
            'order' => 6,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Print)',
            'order' => 7,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Pasang Label)',
            'order' => 8,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Jahit)',
            'order' => 9,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Quality Control)',
            'order' => 10,
        ]);
        TransactionStatusType::create([
            'title' => 'Tahap Proses Produksi (Packing)',
            'order' => 11,
        ]);
        TransactionStatusType::create([
            'title' => 'Produksi Selesai (Menunggu pembayaran)',
            'order' => 12,
        ]);
        TransactionStatusType::create([
            'title' => 'Lunas',
            'order' => 13,
        ]);
        TransactionStatusType::create([
            'title' => 'Pengiriman',
            'order' => 14,
        ]);
        TransactionStatusType::create([
            'title' => 'Selesai',
            'order' => 15,
        ]);

        TransactionStatusType::create([
            'title' => 'Revisi',
            'order' => 16,
        ]);
        TransactionStatusType::create([
            'title' => 'Cancel',
            'order' => 17,
        ]);

        TransactionDetailType::create([
            'title' => 'Jasa Pengiriman',
        ]);
        TransactionDetailType::create([
            'title' => 'Detail Produk',
        ]);

        AccountOpeningBalance::create([
            'account_name_id' => 1,
            'month' => 5,
            'year' => 2024,
            'opening_balances' => 1000000,
        ]);

        PaymentModel::create([
            'title' => 'metode 50:50',
            'model' => '50:50',
            'status_id' => 1,
        ]);
        PaymentModel::create([
            'title' => 'metode 70:30',
            'model' => '70:30',
            'status_id' => 1,
        ]);

        Customer::create([
            'uid' => 'WSHK2024001',
            'name' => 'Mokhamad asif',
            'phone' => '6282132743622',
            'email' => 'mokhamadasif@gmail.com',
            'address' => 'Jalan Kahyangan',
            'province' => 'Jawa Timur',
            'city' => 'Malang',
            'district' => 'Sukun',
            'village' => 'Mulyorejo',
            'postal_code' => '671231',
            'npwp' => null,
            'register' => Carbon::now(),
            'status_id' => 1,
        ]);

        GeneralInfo::create([
            'value' => 'Hai kak ...Kami kirimkan invoce untuk orderan tas custom kamu. Berikut detail transaksi pembayaran:

Nama : [CUSTOMER_NAME]
No invoice : [NO_INVOICE]
Tanggal transaksi : [DATE]
Nominal Transaksi: [TOTAL_TRANSACTION]
Nominal DP yang harus di bayar ([PAYMENT_MODEL_1]% dari Transaksi): [TOTAL]

Kami hanya menerima transaksi melalui rekening berikut :

BCA 4480364029
atas nama Kun Sentanawan

Salam sayang,
@wishka_', 'key' => 'penagihan_termin_1',
        ]);

        CompanyAssetCategory::create([
            'title' => 'Bangunan',
        ]);
        CompanyAssetCategory::create([
            'title' => 'Kendaraan',
        ]);
        CompanyAssetCategory::create([
            'title' => 'Mesin',
        ]);
        CompanyAssetCategory::create([
            'title' => 'Peralatan Pendukung',
        ]);
        CompanyAssetCategory::create([
            'title' => 'Inventaris Kantor',
        ]);
        CompanyAssetCategory::create([
            'title' => 'Sewa DDM',
        ]);
        CompanyAssetCategory::create([
            'title' => 'Biaya DDM',
        ]);

        PaymentStatus::create([
            'title' => 'Diterima',
        ]);
        PaymentStatus::create([
            'title' => 'Disesuaikan',
        ]);
        PaymentStatus::create([
            'title' => 'Ditolak',
        ]);

    }
}
