<?php

use Illuminate\Database\Seeder;

class TypeAttachment extends Seeder      
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $TypeAttachment = [ //Seeding the Tables Type_Attachment with data

	        ['Name_TypesAttachments'=>'File.(PDF)'],
	        ['Name_TypesAttachments'=>'File.(docx)'],
	        ['Name_TypesAttachments'=>'File.(txt)'],
	        ['Name_TypesAttachments'=>'File.(pptx)'],
	        ['Name_TypesAttachments'=>'File.(rar)'],
	        ['Name_TypesAttachments'=>'File.(exe)'],
	        ['Name_TypesAttachments'=>'pictse(png)'],
	        ['Name_TypesAttachments'=>'pictse(jpg)'],
	        ['Name_TypesAttachments'=>'viedoes(Mp4)'],
	        ['Name_TypesAttachments'=>'viedoes(3gp)'],
	        ['Name_TypesAttachments'=>'Audioe(Mp3)'],
	        ['Name_TypesAttachments'=>'web(url)'],
        ];

        DB::table('type_attachments')->insert($TypeAttachment);
    }
}
