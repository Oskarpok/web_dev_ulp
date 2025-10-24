# Description for form fields usage

  Buttons type filds usage 
    For use add namepaces Op\Cms\View\FormFields\Buttons\ButtonsTypeController;

    Sybmitt
    new ButtonsTypeController([


    ]);

    Anchore 
    new ButtonsTypeController([
      'type' => 'Type of button, determines rendering and behavior (anchor)', 
      'route' => 'Route the button should link to /cms/...', 
      'label' => 'Label displayed on the button', 
      'icone' => 'Icon class form FontAwesome or other icon library', 
      'style' => Style of the button (
        0: primary    - bg-emerald-600 hover:bg-emerald-500 text-white  
          Green background white text slightly lighter green on hover  
        1: secondary  - bg-gray-900 hover:bg-gray-800 text-green-400  
          Dark gray background, green text lighter gray on hover  
        2: background - bg-[#0f172a] hover:bg-[#1e293b] text-white  
          Dark navy background, white text slightly lighter navy on hover  
        3: outline    - border border-gray-400 hover:bg-gray-700 text-white  
          Transparent background with gray border white text gray background 
          on hover
      ),
      'name' => 'Name of the button ', 
      'readonly' => Whether the button is read-only or disabled (true or false), 
    ]);


# TD
  Livewier