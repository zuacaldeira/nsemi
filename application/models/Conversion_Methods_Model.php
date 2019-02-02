<?php




/** 
 * Model Class for conversion_methods table.
 */
class Conversion_Methods_Model extends CI_Model {
    
    /**
     * Creates a new instance of this model.
     * @private (used by the framework)
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Reads a conversion method from database with type $type.
     * @param  string $type The type of a conversion method.
     * @return array  An array with a conversion method table row.
     */
    public function read_with_type($type) {
        $query = $this->db->get_where(
            'conversion_methods',
            array(
                'type' => $type
            )
        );
        return $query->row_array();
    }
    
    
}