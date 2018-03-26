<?php

namespace level09\Lib;

/**
 * Class CLIManager
 * @package level09\Lib
 * @todo for now we only support one structure, one source, one target
 * multiple structures makes things messy for driver compatability
 * multiple target drivers should pose no problem
 */
class CLIManager
{
    private $structures = array(
        'Decoration Mesh',
//        'Hull',
        'Eboot Script',
//        'Wad'
    );
    private $drivers = array(
        'Binary',
        'Json',
        'Lua',
//        'Mel',
//        'Mysql',
//        'Pssg',
//        'Xml'
    );
    private $levels = array(
        'Barrens', 'Bryan', 'Canyon', 'Cave', 'Chris', 'Credits',
        'Desert', 'Graveyard', 'Matt', 'Mountain', 'Ruins', 'Summit'
    );
    private $selectedStructure;
    private $selectedSourceDriver;
    private $selectedDestinationDriver;
    private $selectedLevels;

    /**
     * Run prompt for data structure
     */
    public function promptStructure()
    {
        $prompt = 'What kind of data do you want to handle?';
        $selected = $this->cliPrompt( $prompt, $this->structures, "q" );
        $this->selectedStructure = $selected[0];
    }

    /**
     * Run prompt for source input
     */
    public function promptSource()
    {
        $prompt = 'Where do you want to load from?';
        $selected = $this->cliPrompt( $prompt, $this->drivers, "q" );
        $this->selectedSourceDriver = $selected[0];
    }

    /**
     * Run prompt for destination output
     */
    public function promptDestination()
    {
        $prompt = 'Where do you want to export to?';
        $selected = $this->cliPrompt( $prompt, $this->drivers, "q" );
        $this->selectedDestinationDriver = $selected[0];
    }

    public function promptAdditional()
    {
        if ( in_array( $this->getStructure(), array('DecorationMesh', 'Hull') ) )
            $this->promptLevels();
//        if($this->getSourceDriver() == 'Mysql')
//            $this->promptDbCreds
    }

    public function promptLevels()
    {
        $prompt = 'Which levels do you want to handle?';
        $selected = $this->cliPrompt( $prompt, $this->levels, "a");
        if ( in_array( 'All', $selected ) )
            $selected = $this->levels;

        $this->selectedLevels = preg_filter('/^/', 'Level_', $selected);
    }

    /**
     * @return string structure
     * @todo handle multiple structures?
     */
    public function getStructure(): string
    {
        return str_replace( ' ', '', $this->selectedStructure );
    }

    /**
     * @return string source driver
     */
    public function getSourceDriver(): string
    {
        return str_replace( ' ', '', $this->selectedSourceDriver );
    }

    /**
     * @return string destination driver
     */
    public function getDestinationDriver(): string
    {
        return str_replace( ' ', '', $this->selectedDestinationDriver );
    }

    public function getLevels(): array
    {
        return $this->selectedLevels;
    }

    /**
     * @param string $message
     * @param array $choices
     * @param string|null $default
     * @return array
     */
    private function cliPrompt( string $message = "", array $choices, string $default = null ): array
    {
        $selection = array();
        if ( empty( $choices ) )
            exit( "cliPrompt choices misconfigured.\n" );
        if ( $default === null )
            $default = reset( $choices );
        if ( $default === 'a' )
            $choices['a'] = 'All';

        $choices['q'] = 'Quit';
        foreach ( $choices as $index => $option )
            $message .= "\n\t[$index]\t$option";
        echo "$message\n";

        $choiceIndex = array_keys( $choices );
        $choiceStr = join( ", ", $choiceIndex );

        while ( empty( $selection ) ) {
            print "choose [ $choiceStr ] (enter to select $default): ";
            $line = trim( fgets( STDIN ) );
            $selection = $this->isEmptyString( $line )
                ? array( $choices[$default] )
                : $this->parseInput( $line, $choiceIndex, $choices );

            $this->handleSelection( $selection );
        }
        return $selection;
    }

    /**
     * @param $line
     * @param $choiceIndex
     * @param $choices
     * @return array
     */
    private function parseInput($line, $choiceIndex, $choices)
    {
        // regex uses word boundaries to avoid matching "1" to any 2-digit number starting with 1
        $choiceReg = '/\bq\b|\b' . join( '\b|\b', $choiceIndex ) . '\b/i';
        $selection = array();

        foreach ( explode( ',', $line ) as $input ) {
            $input = trim( $input );
            if ( $this->isEmptyString($input) )
                continue;

            $match = array();
            if (! preg_match( $choiceReg, $input, $match ) )
                continue;

            //for now, break after first valid option
            $selection[] = $choices[ $match[0] ];
            break;
        }

        return $selection;
    }

    /**
     * @param $input
     * @return bool
     */
    private function isEmptyString($input)
    {
        return empty( $input ) && $input !== "0";
    }

    /**
     * Handle quit and invalid cases
     * @param $selection
     */
    private function handleSelection($selection)
    {
        if( in_array( 'Quit', $selection ) )
            exit( "Thanks for playing, come again soon!\n" );

        if ( empty( $selection ) )
            print "Invalid selection, try again.\n";
        else
            print "\n[[ You selected " . join( ', ', $selection ) . " ]]\n\n\n";
    }
}