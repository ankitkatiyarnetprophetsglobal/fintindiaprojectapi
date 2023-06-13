<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('slug',56)->unique();
            $table->string('name',256);
			$table->tinyInteger('groupof')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->timestamps();
        });
        
        

DB::table('roles')->insert([ 'slug'=>'school'		, 'name'=>'SCHOOL'      ]);         
DB::table('roles')->insert([ 'slug'=>'youthclub'	, 'name'=>'YOUTH CLUB'  ]);     
DB::table('roles')->insert([ 'slug'=>'subscriber'	, 'name'=>'INDIVIDUAL'  ]);
DB::table('roles')->insert([ 'slug'=>'group'		, 'name'=>'GROUP'       ]);
DB::table('roles')->insert([ 'slug'=>'corporate'	, 'name'=>'CORPORATE'   ]);
DB::table('roles')->insert([ 'slug'=>'ngo'   		, 'name'=>'NGO'         ]);
DB::table('roles')->insert([ 'slug'=>'gym'			, 'name'=>'GYM'         ]);
DB::table('roles')->insert([ 'slug'=>'Nyks'			, 'name'=>'NYKS'        ]);
DB::table('roles')->insert([ 'slug'=>'crpf'			, 'name'=>'CRPF'        ]);
DB::table('roles')->insert([ 'slug'=>'bsf'			, 'name'=>'BSF'         ]);
DB::table('roles')->insert([ 'slug'=>'railways'		, 'name'=>'RAILWAYS'    ]);
DB::table('roles')->insert([ 'slug'=>'nss'			, 'name'=>'NSS'         ]);
DB::table('roles')->insert([ 'slug'=>'gram_panchayat', 'name'=>'GRAM PANCHAYAT']);
DB::table('roles')->insert([ 'slug'=>'universities'	, 'name'=>'UNIVERSITIES / INSTITUTE / COLLEGE']);
DB::table('roles')->insert([ 'slug'=>'others'		, 'name'=>'Others'      ]);
DB::table('roles')->insert([ 'slug'=>'sai_user'		, 'name'=>'SAI User'    ]);
DB::table('roles')->insert([ 'slug'=>'author'		, 'name'=>'Author'      ]);
DB::table('roles')->insert([ 'slug'=>'mha'			, 'name'=>'Ministry of Home Affairs',                      'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mwcd'			, 'name'=>'Ministry of Women and Child Development',       'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mhrddsel'		, 'name'=>'Ministry of Human Resource Development (DSEL)', 'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mhrdhei'		, 'name'=>'Ministry of Human Resource Development (HEI)',  'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mpr'			, 'name'=>'Ministry of Panchayati Raj',                    'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mrd'			, 'name'=>'Ministry of Rural Development',                 'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mta'			, 'name'=>'Ministry of Tribal Affairs',                    'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mhfw'			, 'name'=>'Ministry of Health and Family Welfare',         'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'md'			, 'name'=>'Ministry of Defence',                           'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mhua'			, 'name'=>'Ministry of Housing and Urban Affairs',         'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mayush'		, 'name'=>'Ministry of AYUSH',                             'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mafw'			, 'name'=>'Ministry of Agriculture and Farmers Welfare',   'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mcf'			, 'name'=>'Ministry of Chemicals and Fertilizers',         'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mcivila'		, 'name'=>'Ministry of Civil Aviation',                    'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mcoal'		, 'name'=>'Ministry of Coal',                              'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mci'			, 'name'=>'Ministry of Commerce and Industry',             'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mcomm'		, 'name'=>'Ministry of Communications',                    'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mconsumera'	, 'name'=>'Ministry of Consumer Affairs, Food and Public Distribution','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mcorpa'		, 'name'=>'Ministry of Corporate Affairs',   'groupof'=>1]);                   
DB::table('roles')->insert([ 'slug'=>'mculture'		, 'name'=>'Ministry of Culture',    'groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mdner'		, 'name'=>'Ministry of Development of North Eastern Region','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mearths'		, 'name'=>'Ministry of Earth Sciences','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'meit'			, 'name'=>'Ministry of Electronics and Information Technology','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mefcc'		, 'name'=>'Ministry of Environment, Forest and Climate Change','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mexta'		, 'name'=>'Ministry of External Affairs','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mfinance'		, 'name'=>'Ministry of Finance','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mfahd'		, 'name'=>'Ministry of Fisheries, Animal Husbandry and Dairying','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mfpi'			, 'name'=>'Ministry of Food Processing Industries','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mhipe'		, 'name'=>'Ministry of Heavy Industries and Public Enterprises','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mib'			, 'name'=>'Ministry of Information and Broadcasting','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mjs'			, 'name'=>'Ministry of Jal Shakti','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mle'			, 'name'=>'Ministry of Labour and Employment','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mlj'			, 'name'=>'Ministry of Law and Justice','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mmsme'		, 'name'=>'Ministry of Micro, Small and Medium Enterprises','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mmines'		, 'name'=>'Ministry of Mines','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mminoritya'	, 'name'=>'Ministry of Minority Affairs','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mmre'			, 'name'=>'Ministry of New and Renewable Energy','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mpa'			, 'name'=>'Ministry of Parliamentary Affairs','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mppgp'		, 'name'=>'Ministry of Personnel, Public Grievances and Pensions','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mpng'			, 'name'=>'Ministry of Petroleum and Natural Gas','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mpower'		, 'name'=>'Ministry of Power','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mrailways'	, 'name'=>'Ministry of Railways','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mtransh'		, 'name'=>'Ministry of Road Transport and Highways','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'msciencetech'	, 'name'=>'Ministry of Science and Technology','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mshipping'	, 'name'=>'Ministry of Shipping','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mskillde'		, 'name'=>'Ministry of Skill Development and Entrepreneurship','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'msje'			, 'name'=>'Ministry of Social Justice and Empowerment','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'msprog'		, 'name'=>'Ministry of Statistics and Programme Implementation','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'msteel'		, 'name'=>'Ministry of Steel','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mtextiles'	, 'name'=>'Ministry of Textiles','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'mtourism'		, 'name'=>'Ministry of Tourism','groupof'=>1]);
DB::table('roles')->insert([ 'slug'=>'myouthas'		, 'name'=>'Ministry of Youth Affairs and Sports','groupof'=>1]);
       

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
