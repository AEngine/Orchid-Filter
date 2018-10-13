# Changelog

The latest version of this file can be found at the master branch of the this repository.

## 1.2.1 (2018-10-01)
- Add dependency orchid-annotation from a separate repo

### 1.2.0 (2018-10-01)
- AbstractFilter is deprecated, now use Filter
- Add FilterAnnotation
- Add FilterModel
- Add Required annotation
- Add dependency from aengine/orchid ^1.2.0 (annotation engine)

### 1.1.4 (2018-06-11)
- Remove dependency from aengine/orchid

### 1.1.3 (2017-12-02)
- Update dependency

### 1.1.2 (2017-11-11)
- Global rules now check only those fields that have been selected through the `attr` or `option` methods

### 1.1.1 (2017-11-04)
- Rename trait file from `TraitHelper` to `TraitFilter`

### 1.1.0 (2017-09-13)
- Merging rules into common trait named `TraitHelper`
- All Sanitize Rules named as `lead{old_name}` (e.g. `leadBetween`, `leadLowercase`) 
- All Validate Rules named as `check{old_name}` (e.g. `checkBoolean`, `checkCreditCard`) 

### 1.0.0 (2016-11-30)
- Code transferred from the Orchid project
- Add composer support
- Add many more validates and sanitizes
- Rename Validator in to AbstractFilter
