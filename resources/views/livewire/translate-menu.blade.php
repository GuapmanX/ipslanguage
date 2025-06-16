<div>
        <?php
            foreach($Courses as $Course){
                $this->DrawAccordionMenu(
                    true,
                    $Course['Name'],
                    $this->CalulateTranslateAverage($Course['TranslateData']),
                    "bg-white",
                    $this->GetModules($Course['Children'])
            );
            }
        
        ?>
</div>
