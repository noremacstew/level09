#!/bin/sh

#####################################
#
# EXTRACT USAGE: jterrain.sh FolderNameToExtractTo FolderNameToBackupInto
# Arguments are a folder to extract into, and a folder to copy the extracted
# data into. This way you can save the original, edit the copy, and restore
# either one later.
# 
# IMPORT USAGE: jterrain.sh -r RestoreFromThisFolderName
# Flag "-r" sets re-import mode.
# Argument is a folder from which to import. The folder does NOT need to
# have all 4 textures. If any files are missing, then those sections of
# TerrainData won't be overwritten.
# 
#####################################

EXTRACTDIR=$1
MODIFIED=$2
STARTDIR=`pwd`
CYGHOME=`cygpath -w -p "$HOME"`
SCRIPTPATH=$CYGHOME\\bin\\JourneyTerrain.bms

echo ""
echo "Starting from $STARTDIR"
echo "Extracting to $EXTRACTDIR/..."
echo "Backing up to $MODIFIED/..."
echo ""

if [ "$1" != "-r" ]; then

  # Extract
  gunzip TerrainData.bin.gz
  mkdir $EXTRACTDIR
  quickbms.exe $SCRIPTPATH TerrainData.bin $EXTRACTDIR

  cd $EXTRACTDIR
  convert -depth 8 -size 256x512 gray:BlockMapA.raw BlockMapA.tif
  convert -depth 8 -size 256x512 gray:BlockMapB.raw BlockMapB.tif
  convert -depth 8 -size 256x512 -define tiff:alpha=unspecified RGBA:DustMap.raw -type TrueColorMatte tif:DustMap.tif
  convert -depth 16 -size 256x512+0 -endian MSB gray:HeightMap.raw HeightMap.tif
  cd $STARTDIR

  # TODO: check if backup folder exists and warn/exit if so.
  # We don't want to overwrite good work
  if [ $# = 2 ]; then
    cp -R $EXTRACTDIR $MODIFIED
  fi

  exit 1
else
  # Restore
  cd $MODIFIED
  #TODO: check for existence of each component and skip if not
  stream -map i -depth 8 BlockMapA.tif BlockMapA.raw
  stream -map i -depth 8 BlockMapB.tif BlockMapB.raw
  stream -map rgba -storage-type char DustMap.tif DustMap.raw
  convert -depth 16 -endian MSB HeightMap.tif HeightMap.gray
  mv HeightMap.gray HeightMap.raw

  # TODO: check for existence of TerrainData.bin file and warn/exit if not
  cd $STARTDIR
  quickbms.exe -w -r $SCRIPTPATH TerrainData.bin $MODIFIED
  gzip TerrainData.bin

  exit 1
fi
