import os
import re

def get_directory_info():
    """Reads directories and their descriptions."""
    info = []
    # Adjust this line to list only the directories you want
    dirs = [d for d in os.listdir('.') if os.path.isdir(d) and not d.startswith('.')]
    
    for d in sorted(dirs):
        desc_path = os.path.join(d, 'readme.md')
        description = 'No description available.'
        
        if os.path.exists(desc_path):
            with open(desc_path, 'r') as f:
                description = f.read().strip()
        
        info.append({'name': d, 'description': description})
        
    return info

def generate_markdown_table(data):
    """Generates a Markdown table from the directory info."""
    table = "| Module | Description |\n"
    table += "|---|---|\n"
    for item in data:
        table += f"| [{item['name']}]({item['name']}) | {item['description']} |\n"
    return table

def update_readme(new_table):
    """Updates the README.md file with the new table."""
    readme_path = 'README.md'
    start_tag = ''
    end_tag = ''
    
    with open(readme_path, 'r') as f:
        readme_content = f.read()
    
    # Use regex to find and replace the content between the tags
    updated_content = re.sub(
        f'{start_tag}.*?{end_tag}',
        f'{start_tag}\n{new_table}\n{end_tag}',
        readme_content,
        flags=re.DOTALL
    )
    
    with open(readme_path, 'w') as f:
        f.write(updated_content)

if __name__ == "__main__":
    dir_info = get_directory_info()
    markdown_table = generate_markdown_table(dir_info)
    update_readme(markdown_table)
    print("README.md table updated successfully.")
