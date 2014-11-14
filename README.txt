Release 1.1.0
	- All data from the fe_users record is available through markers. (yes, password included, but you shouldn't display it!)
	  All markers are prefixed with FEUSER_ so in order to display a fe_users field, write it like this

	  ###FEUSER_IMAGE###

	- You can apply stdWrap to all markers, just follow EXT:comments own examples or read here.
	  Using the frontend user image in your comments, you can change the size the following way:

	  plugin.tx_comments_pi1 {
      	feuser_image_stdWrap {
      		setContentToCurrent = 1
      		cObject = COA
      		cObject {
      			10 = IMAGE
      			10 {
      				file.import.current = 1
      				file.import = uploads/pics/
      				file.listNum = 0
      				file.width = 79
      				file.height = 65
      			}
      		}
      	}
      }