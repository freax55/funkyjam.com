##          Movable Type configuration file                   ##
##                                                            ##
## This file defines system-wide settings for Movable Type    ##
## In total, there are over a hundred options, but only those ##
## critical for everyone are listed below.                    ##
##                                                            ##
## Information on all others can be found at:                 ##
## http://www.movabletype.org/documentation/appendices/config-directives/ ##

################################################################
##################### REQUIRED SETTINGS ########################
################################################################

# The CGIPath is the URL to your Movable Type directory
CGIPath    /admin/mt/

# The StaticWebPath is the URL to your mt-static directory
# Note: Check the installation documentation to find out 
# whether this is required for your environment.  If it is not,
# simply remove it or comment out the line by prepending a "#".
StaticWebPath    /admin/mt/mt-static

#================ DATABASE SETTINGS ==================
#   REMOVE all sections below that refer to databases 
#   other than the one you will be using.

##### MYSQL #####
ObjectDriver DBI::mysql
Database funkyjam
DBUser funkyjam
DBPassword Wi2Mi9gm
DBHost localhost

PublishCharset Shift_JIS