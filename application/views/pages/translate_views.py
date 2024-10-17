import os
import re
from googletrans import Translator

def translate_content(content):
    translator = Translator()
    
    # Fonction pour traduire les correspondances
    def translate_match(match):
        text = match.group(1)
        translated = translator.translate(text, dest='fr').text
        return f"<?php echo display('{translated}'); ?>"

    # Traduire les appels à display()
    content = re.sub(r"<?php echo display\('(.+?)'\); ?>", translate_match, content)
    
    # Traduire le texte visible (en dehors des balises PHP)
    content = re.sub(r'>([^<]+)<', lambda m: '>' + translator.translate(m.group(1), dest='fr').text + '<', content)
    
    return content

def translate_file(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        content = file.read()
    
    translated_content = translate_content(content)
    
    new_file_path = file_path[:-4] + '_fr.php'
    with open(new_file_path, 'w', encoding='utf-8') as file:
        file.write(translated_content)
    
    print(f"Traduit : {file_path} -> {new_file_path}")

def main():
    directory = './pages'  # Chemin vers le dossier 'pages'
    for filename in os.listdir(directory):
        if filename.endswith('.php'):
            translate_file(os.path.join(directory, filename))

if __name__ == '__main__':
    main()