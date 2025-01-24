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
use App\Models\TransactionType;
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

//        User::create([
//            'name' => 'Test User',
//            'email' => 'admin@admin',
//            'password' => bcrypt('admin'),
//            'role' => 1,
//            'position' => 'Pemilik',
//        ]);
//        TransactionType::create([
//            'title' => 'By Order'
//        ]);
//        TransactionType::create([
//            'title' => 'E Catalog'
//        ]);
//        TransactionType::create([
//            'title' => 'Pinjam Bendera'
//        ]);
    }
}
