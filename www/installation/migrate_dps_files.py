import os
from shutil import copyfile

print 'DEBUT'
print ''

root_src_directory = "../dps"
root_dst_directory = "../documents_dps"

def get_immediate_subdirectories(a_dir):
    return [name for name in os.listdir(a_dir)
            if os.path.isdir(os.path.join(a_dir, name))]

def get_immediate_files(a_dir):
    return [name for name in os.listdir(a_dir)
            if os.path.isfile(os.path.join(a_dir, name))]


# Get all section folders
commune_directory_names = get_immediate_subdirectories(root_src_directory)
print 'Found', len(commune_directory_names), 'section directories. Exploring'

for commune_directory_name in commune_directory_names:
	# List all subdirectories (=DPS)
	old_commune_directory_path = root_src_directory + '/' + commune_directory_name
	dps_directory_names = get_immediate_subdirectories(old_commune_directory_path)
	print '>', commune_directory_name + ': Found', len(dps_directory_names), 'DPS'

	for old_dps_directory_name in dps_directory_names:
		# Get DPS number and year
		year = old_dps_directory_name[:4]
		dps_number = old_dps_directory_name[-3:]

		# Create dps folder (into yearly folder / section folder)
		new_dps_directory_path = root_dst_directory + '/' + year + '/' + commune_directory_name + '/' + dps_number
		if not os.path.exists(new_dps_directory_path):
    			os.makedirs(new_dps_directory_path)

		# List all files
		old_dps_directory_path = old_commune_directory_path + '/' + old_dps_directory_name
		dps_file_names = get_immediate_files(old_dps_directory_path)
		print ' ', old_dps_directory_name, ': Found', len(dps_file_names), 'files'
		for dps_file in dps_file_names:
			# Copy file
			print '    Copying file:', dps_file
			copyfile (old_dps_directory_path + '/' + dps_file, new_dps_directory_path + '/' + dps_file)


print ''
print 'FIN'
