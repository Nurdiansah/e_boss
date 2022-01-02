<?php

namespace Database\Seeders;

use App\Models\Stevedoring;
use Illuminate\Database\Seeder;

class StevedoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stevedoring::create([
            'area_id' => '1',
            'client_id' => '2',
            'vessel_id' => '1',
            'agent_id' => '2',
            'jetty_id' => '1',
            'stevedoringcategory_id' => '2',
            'entry_date' => '2021-10-31 00:35:00',
            'exit_date' => '2021-11-02 00:35:00',
            'orign_port' => 'Matak',
            'destination_port' => 'Jakarta',
            'command_document' => 'Email 30 Oktober 2021',
            'wo_number' => '12312556',
            'doc_ptw' => 'stevedoring/doc_ptws/lgRBTUW50YsVnFECb9uRfIHptjqeu3jlK8yUxdI2.pdf',
            'doc_pjsm' => 'stevedoring/doc_pjsms/zGtOJgrXm4AB8rDLL6DhjnRw1fPt5p60xmh30bYz.pdf',
            'doc_lsap' => 'stevedoring/doc_lsaps/NOhFQJmIg7iba5TwSpLbwBtQ558sjqP1I285gg4C.pdf',
            'status' => '0',
        ]);

        Stevedoring::create([
            'id' => '2',
            'area_id' => '4',
            'client_id' => '1',
            'vessel_id' => '4',
            'agent_id' => '1',
            'jetty_id' => '4',
            'stevedoringcategory_id' => '1',
            'entry_date' => '2021-10-30 00:36:00',
            'exit_date' => '2021-11-01 00:36:00',
            'orign_port' => 'Jakarta',
            'destination_port' => 'Matak',
            'command_document' => 'Email 20 Oktober 2021',
            'wo_number' => '1231231',
            'doc_ptw' => 'stevedoring/doc_ptws/cDq0HzJsLTdSfstQC3HhknkMtYorgIoz79B0d6b8.pdf',
            'doc_pjsm' => 'stevedoring/doc_pjsms/2wgJzjT3cAAJDQKomeCeR0imkMdyLxzctqZICiwD.pdf',
            'doc_lsap' => 'stevedoring/doc_lsaps/BGgCfu6ClMKpofrm32hfl6eLbkLuuPy140sp9ca5.pdf',
            'status' => '0',
            'created_at' => '2021-10-30 00:39:10',
            'updated_at' => '2021-10-30 00:39:10'
        ]);
    }
}
