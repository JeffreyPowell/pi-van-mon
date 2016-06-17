#!/bin/bash

echo 'hook file'

changed_files="$(git diff-tree -r --name-only --no-commit-id ORIG_HEAD HEAD)"

echo $changed_files
