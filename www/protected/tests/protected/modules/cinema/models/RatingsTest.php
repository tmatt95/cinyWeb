<?php

require_once dirname(__FILE__) . '/../../../../../modules/cinema/models/Ratings.php';

/**
 * Test class for Ratings.
 * Generated by PHPUnit on 2011-12-13 at 19:56:35.
 */
class RatingsTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Ratings
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Ratings;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * @covers {className}::{origMethodName}
	 * @todo Implement testModel().
	 */
	public function testModel() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers {className}::{origMethodName}
	 * @todo Implement testTableName().
	 */
	public function testTableName() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers {className}::{origMethodName}
	 * @todo Implement testRules().
	 */
	public function testRules() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers {className}::{origMethodName}
	 * @todo Implement testRelations().
	 */
	public function testRelations() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers {className}::{origMethodName}
	 * @todo Implement testAttributeLabels().
	 */
	public function testAttributeLabels() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	public function testGetAllRatings() {
		// Checks to ensure that the array which is returned contains values
		$this->assertNotEmpty($this->object->getAllRatings());
	}

	public function testSearch() {
		// Checks to ensure that the correct object is being returned from the
		// search function
		$this->assertInstanceOf(
			'CActiveDataProvider',
			$this->object->search()
		);
	}

}
?>