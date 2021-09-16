<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
          ['Environmental consulting', 'استشارات بيئية', 'Preparing environmental proposals for various projects. Conducting field visits and inspections for projects to determine the environmental impacts resulting from them, and then directing and making recommendations to mitigate environmental impacts in accordance with the approved standard specifications. Preparing and preparing the environmental record for various projects and periodic follow-up for clients.', 'إعداد المقترحات البيئية للمشروعات المختلفة. عمل الزيارات والمعاينات الميدانية للمشروعات للوقوف على الأثار البيئية المترتبة عليها ومن ثم التوجيه وعمل التوصيات لتخفيف الأثار البيئية طبقا للمواصفات القياسية المعتمدة . عمل وإعداد السجل البيئي للمشروعات المختلفة والمتابعة الدورية للعملاء.'],
          ['Maintenance and technical support', 'الصيانة والدعم الفني', 'The company provides maintenance and technical support services for all laboratory and laboratory equipment for all models through the Adecco maintenance and technical support team supported by highly qualified engineers with a high level of professionalism to conduct maintenance work and make a plan and maintenance programs for the devices.', 'تقدم الشركة خدمات الصيانة والدعم الفني لجميع الأجهزة المعملية والمخبرية لجميع الموديلات وذلك من خلال فريق شركة اديكو للصيانة والدعم الفني المُدعم بمهندسين مؤهلين تأهيلاً عالياً وعلى مستوي عالي من المهنية لإجراء اعمال الصيانة وعمل خطة وبرامج الصيانة اللازمة للأجهزة.'],
          ['Solar energy', 'الطاقة الشمسية', 'Adeco Solar team integrated solutions in terms of project engineering, implementation and start-up with efficiency and high quality, as there are engineers with great experience in the fields of solar and renewable energy.', 'فريق أديكو سولار الحلول المتكاملة من حيث هندسة المشاريع والتنفيذ وبدء التشغيل بكفائه وجودة عالية حيث يوجد لديكو مهندسون بخبرات كبيرة في مجالات الطاقة الشمسية والمتجددة.'],
          ['Laboratories run', 'تشغيل المختبرات', 'The company meets the needs and requirements of regulatory authorities and public and private sector institutions concerned with food safety affairs by providing qualified consultants on the latest methods of testing in various fields. This is to conduct chemical and microbiological analyzes for various food and water samples and to provide the results of the analyzes in accordance with the highest quality standards. As well as consultations and recommendations in order to improve the quality and safety of food.', 'تقوم الشركة بتلبية إحتياجات ومتطلبات الجهات الرقابية ومؤسسات القطاع العام والخاص المعنية بشؤون سلامة الغذاء من خلال توفير استشاريين مؤهلين على أحدث طرق الاختبارات في المجالات المختلفة. وذلك لعمل التحاليل الكيميائية والميكرو بيولوجية لعينات الأغذية المختلفة والمياه وتقديم نتائج التحاليل بما يتوافق مع أعلى معايير للجودة. وكذلك الاستشارات والتوصيات من أجل تحسين نوعية وسلامة الغذاء.'],
          ['Information Technology', 'تكنولوجيا المعلومات', 'Our current efforts are focused on providing the client with the most advanced and advanced solutions in the field of business administration, information technology applications, programming fields, design of phone applications, financial and administrative systems, and websites, and providing technical advice in modern technology and infrastructure using the most advanced tools available in this field to meet all business challenges.', 'تتركز جهودنا الحالية على تزويد العميل بالحلول الأكثر تطورا وتقدما في مجال إدارة الأعمال وتطبيقات تكنولوجيا المعلومات ومجالات البرمجة وتصميم تطبيقات الهواتف والانظمة المالية والادارية والمواقع الإلكترونية وتقديم الاستشارات الفنية فى التقنية الحديثة والبنية التحتية باستخدام أكثر الأدوات تقدما والمتاحة في هذا المجال لمواجهة كافة تحديات العمل.'],
        ];

        foreach ($services as $row)
        {
            Service::create([
                'name_en'=>$row[0],
                'name_ar'=>$row[1],
                'slug'=>str_replace(' ', '-', $row[0]),
                'small_description_en'=>$row[2],
                'small_description_ar'=>$row[3],
                'description_en'=>'none',
                'description_ar'=>'none',
                'slider_phrase_en'=>'Need to take proper step?',
                'slider_phrase_ar'=>'بحاجة لاتخاذ الخطوة المناسبة؟',
            ]);
        }
    }
}
